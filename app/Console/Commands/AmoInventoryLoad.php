<?php

namespace App\Console\Commands;

use App\AmoPipeline;
use App\AmoUser;
use App\Classes\Site\Amo\AmoCRMApiClientBuilder;
use Illuminate\Console\Command;

class AmoInventoryLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amo-inventory:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Загружает воронки из AmoCrm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client = AmoCRMApiClientBuilder::getInstance()->getClient();

        $pipelines = $client->pipelines()
            ->get()
            ->all();

        foreach ($pipelines as $pipeline) {
            $pipelineModel = AmoPipeline::firstOrNew(['amo_id' => $pipeline->id]);
            $pipelineModel->name = $pipeline->name;
            $pipelineModel->save();
        }

        $users = $client->users()
            ->get()
            ->all();

        foreach ($users as $user) {
            $userModel = AmoUser::firstOrNew(['amo_id' => $user->id]);
            $userModel->name = $user->name;
            $userModel->save();
        }

        return 0;
    }
}
