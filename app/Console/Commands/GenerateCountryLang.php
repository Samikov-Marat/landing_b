<?php

namespace App\Console\Commands;

use App\Country;
use App\Site;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GenerateCountryLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'генерируем ланг-файлы для всех сайтов, где есть форма заказа';

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
        $sites = Site::select(['id', 'domain'])
            ->whereHas('pages', function (Builder $query) {
                $query->where('id', 38);
            })
            ->with('languages')
            ->get();

        $countries = Country::select(['id', 'jira_code'])
            ->get();

        foreach ($sites as $site) {
            $this->dumpSite($site, $countries);
        }

        return 0;
    }

    private function dumpSite(Site $site, Collection $countries)
    {
        $fileName = Storage::path('langust/' . $site->domain . '.csv');
        $directoryName = dirname($fileName);
        if(!file_exists($directoryName)){
            mkdir($directoryName, 0755, true);
        }
        $file = fopen($fileName, 'w');

        $line = [];
        $line[] = 'Первые две строки менять нельзя';
        foreach ($site->languages as $language) {
            $line[] = $language->id;
        }
        fputcsv($file, $line, self::SEPARATOR);

        $line = [];
        $line[] = 'Первый столбец менять нельзя';
        foreach ($site->languages as $language) {
            $line[] = $language->name;
        }
        fputcsv($file, $line, self::SEPARATOR);


        foreach ($countries as $country) {
            $line = $this->getLine($site, $country);
            fputcsv($file, $line, self::SEPARATOR);
        }
        fclose($file);
    }

    private function getLine(Site $site, Country $country):array
    {
        $line = [];
        $line[] = 'country_text.' . $country->id . '.value';
        $line[] = $country->jira_code;
        foreach ($site->languages as $language) {
            $line[] = '';
        }
        return $line;
    }

}
