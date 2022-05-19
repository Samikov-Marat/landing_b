<?php

namespace App\Console\Commands;

use App\Classes\OfficeUpdater;
use App\EngOffice;
use App\Office;
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
        OfficeUpdater::getInstance(Office::class)
            ->setSource(env('OFFICES_GEO_XML') . '?lang=rus')
            ->setFilename('geo_rus.xml')
            ->update();

        OfficeUpdater::getInstance(EngOffice::class)
            ->setSource(env('OFFICES_GEO_XML') . '?lang=eng')
            ->setFilename('geo_eng.xml')
            ->update();


        return 0;
    }
}
