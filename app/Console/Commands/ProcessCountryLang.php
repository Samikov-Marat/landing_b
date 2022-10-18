<?php

namespace App\Console\Commands;

use App\Country;
use App\CountryText;
use App\Site;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProcessCountryLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Применяем ланг-файлы для всех сайтов, где есть форма заказа';

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
    public function handle()
    {
        $fileNames = Storage::files('countries/');
        foreach ($fileNames as $fileName) {
            $this->parseFile(Storage::path($fileName));
        }


//        $sites = Site::select(['id', 'domain'])
//            ->whereHas('pages', function (Builder $query) {
//                $query->where('id', 38);
//            })
//            ->with('languages')
//            ->get();
//
//        $countries = Country::select(['id', 'jira_code'])
//            ->get();
//
//        foreach ($sites as $site) {
//            $this->dumpSite($site, $countries);
//        }

        return 0;
    }

    private function parseFile($fileName)
    {
        $file = fopen($fileName, 'r');
        $header = fgetcsv($file);
        fgetcsv($file);
        while (($line = fgetcsv($file)) !== false) {
            $this->saveLine($header, $line);
        }
    }

    private function saveLine($header, $line)
    {
        if(count($header) != count($line)){
            return;
        }


        $countryId = explode('.', $line[0])[1];

        for ($column = 2; $column < count($header); $column++){
            $countrytext = new CountryText();
            $countrytext->country_id = $countryId;
            $countrytext->language_id = $header[$column];
            $countrytext->value = $line[$column];
            $countrytext->save();
        }

    }

}
