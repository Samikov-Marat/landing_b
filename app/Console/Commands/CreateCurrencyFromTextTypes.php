<?php

namespace App\Console\Commands;

use App\Site;
use Illuminate\Console\Command;

class CreateCurrencyFromTextTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:currencies';

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
        $sites = Site::all()->load([
            'pages' => function ($query) {
                $query->where('name', 'Калькулятор');
            },
            'pages.textTypes' => function ($query) {
                $query->where('shortname', 'calculator_currency_name');
            },
            'pages.textTypes.texts'
        ]);

        return 0;
    }
}
