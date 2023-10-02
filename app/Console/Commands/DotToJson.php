<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class DotToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dot-to-json:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private $lang = [];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lang = [];

        $input = fopen(Storage::disk('local')->path('tmp/zho.csv'), 'r');

        while (($row = fgetcsv($input)) !== false) {
            if (is_null($row)) {
                continue;
            }
            Arr::set($this->lang, $row[0], $row[1]);
        }
        fclose($input);



        $output = fopen(Storage::disk('local')->path('tmp/zho.json'), 'w');
        fwrite($output, json_encode($this->lang, JSON_FORCE_OBJECT|JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        fclose($output);
        return 0;
    }
}
