<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class JsonToDot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'json-to-dot:process';

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

    private $flat = [];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $langTree = json_decode(Storage::disk('local')->get('tmp/zho.json'), JSON_OBJECT_AS_ARRAY);
        $this->recursive($langTree);
        $output = fopen(Storage::disk('local')->path('tmp/zho.csv'), 'w');
        foreach ($this->flat as $line) {
            fputcsv($output, $line);
        }
        fclose($output);
        return 0;
    }

    private function recursive(array $langTree, string $prefix = '')
    {
        foreach ($langTree as $k => $item) {
            if (is_array($item)) {
                $this->recursive($item, $prefix . $k . '.');
            } else {
                $this->flat[] = [0 => $prefix . $k, 1 => $item];
            }
        }
    }

}
