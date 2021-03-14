<?php

namespace App\Console\Commands;

use App\Classes\SiteCloner;
use Illuminate\Console\Command;

class SiteClone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:clone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make clone site';

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
        SiteCloner::getInstance()
            ->setSite(1)
            ->setLanguage(10)
            ->makeClone();
        return 0;
    }
}
