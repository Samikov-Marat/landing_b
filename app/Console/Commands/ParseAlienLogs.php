<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ParseAlienLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alien-logs:parse';

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileNames = Storage::files('api_marketing_logs_jira/');

        $ids = [];
        foreach ($fileNames as $fileName) {
            $contents = Storage::get($fileName);
            $m = [];
            preg_match_all('#tilda_request\.id=([\d]+)\n.*?\n.*?"customfield_16814":"Идентификатор функции «null» недействителен"#', $contents, $m);

            $ids = array_merge($ids, $m[1]);
        }
        dump(implode(',', $ids));

        return 0;
    }
}
