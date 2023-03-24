<?php

namespace App\Console\Commands;

use AmoCRM\Exceptions\AmoCRMApiPageNotAvailableException;
use AmoCRM\Filters\PagesFilter;
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

    public function handle(): int
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

        $filter = new PagesFilter();
        $filter->setLimit(70);
        $users = $client->users()
            ->get($filter);

        while (true) {
            foreach ($users->all() as $user) {
                $userModel = AmoUser::firstOrNew(['amo_id' => $user->id]);
                $userModel->name = $user->name;
                $userModel->save();
            }

            try {
                $users = $client->users()
                    ->nextPage($users);
            } catch (AmoCRMApiPageNotAvailableException $e) {
                break;
            }
        }
        return 0;
    }
}
