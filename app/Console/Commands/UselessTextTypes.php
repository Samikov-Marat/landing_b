<?php

namespace App\Console\Commands;

use App\Classes\TextTypesCleaner;
use Illuminate\Console\Command;

class UselessTextTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'useless_text_types:clear';

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
        $textTypesCleaner = new TextTypesCleaner();

        $textTypesCleaner->clear();

        return 0;
    }
}
