<?php

namespace App\Console\Commands;

use App\Classes\Admin\OfficeApi;
use App\OfficeUuid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoadOfficesByApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:offices-by-api';

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
        $uuids = OfficeUuid::select(['uuid'])
            ->limit(1000)
        ->get();

        $pause = 0;
        foreach ($uuids as $uuid) {
            usleep($pause);
            Log::info('Получаем из API ' . $uuid->uuid);
            (new OfficeApi)->load($uuid->uuid);
            $pause = 200;
            $uuid->delete();
        }
        return 0;
    }
}
