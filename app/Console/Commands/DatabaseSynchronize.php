<?php

namespace App\Console\Commands;

use App\Classes\DatabaseSynchronizer;
use Illuminate\Console\Command;

class DatabaseSynchronize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:synchronize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load database from dev';

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
        DatabaseSynchronizer::take();
        return 0;
    }
}
