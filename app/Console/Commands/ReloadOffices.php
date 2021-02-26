<?php

namespace App\Console\Commands;

use App\Classes\OfficeUpdater;
use Illuminate\Console\Command;

class ReloadOffices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offices:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление списка офисов с API интеграции';

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
        OfficeUpdater::getInstance()
            ->update();
        return 0;
    }
}
