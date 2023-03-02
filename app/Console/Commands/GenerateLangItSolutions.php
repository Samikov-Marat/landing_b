<?php

namespace App\Console\Commands;

use App\Site;
use App\TextType;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateLangItSolutions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-lang:it-solutions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'генерируем ланг-файлы для всех сайтов';

    const SEPARATOR = ',';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $ids = [1, 3, 4, 6, 7, 8, 9, 11, 12, 13, 14, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 32, 35, 37, 38, 39, 40,];

        $sites = Site::select(['id', 'domain'])
            ->whereIn('id', $ids)
            ->with('languages')
            ->get();

        $textTypes = TextType::select(['id', 'default_value'])
            ->where('page_id', 48)
            ->orderBy('sort')
            ->get();

        foreach ($sites as $site) {
            $this->dumpSite($site, $textTypes);
        }

        return 0;
    }

    private function dumpSite(Site $site, Collection $textTypes)
    {
        $fileName = Storage::path('langust2/' . $site->domain . '.csv');
        $directoryName = dirname($fileName);
        if (!file_exists($directoryName)) {
            mkdir($directoryName, 0755, true);
        }
        $file = fopen($fileName, 'w');

        $line = [];
        $line[] = 'Первые две строки менять нельзя';
        $line[] = $site->languages->first()->id;
        foreach ($site->languages as $language) {
            $line[] = $language->id;
        }
        fputcsv($file, $line, self::SEPARATOR);

        $line = [];
        $line[] = 'Первый столбец менять нельзя';
        $line[] = 'Текст для перевода';
        foreach ($site->languages as $language) {
            $line[] = $language->name;
        }
        fputcsv($file, $line, self::SEPARATOR);


        foreach ($textTypes as $country) {
            $line = $this->getLine($site, $country);
            fputcsv($file, $line, self::SEPARATOR);
        }
        fclose($file);
    }

    private function getLine(Site $site, TextType $textType): array
    {
        $line = [];
        $line[] = $textType->id;
        $line[] = $textType->default_value;
        foreach ($site->languages as $language) {
            $line[] = Str::startsWith($language->name, 'Английский') ? $textType->default_value : '';
        }
        return $line;
    }

}
