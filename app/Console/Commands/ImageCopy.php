<?php

namespace App\Console\Commands;

use App\Classes\ImageCopier;
use Illuminate\Console\Command;

class ImageCopy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:copy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy images from dev';

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
        ImageCopier::copy();
        return 0;
    }
}
