<?php

namespace App\Console\Commands;

use AmoCRM\OAuth2\Client\Provider\AmoCRM;
use App\AmoPipeline;
use App\Classes\Site\Amo\AccessTokenMemento;
use App\Classes\Site\Amo\AmoCRMApiClientBuilder;
use App\Classes\Site\Amo\AmoSender;
use Illuminate\Console\Command;
use League\OAuth2\Client\Grant\AuthorizationCode;

class TestAmo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'amo:test';

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
        $client = AmoCRMApiClientBuilder::getInstance()->getClient();

        AmoSender::getInstance($client)->send([
                                                  '2114857' => 'Тестируем админку',
                                                  '2114859' => 'Телефон',
                                                  '2114861' => 'WhatsApp',
                                                  '2114863' => 'Email',
                                                  '2114865' => 'Город',
                                              ]);
        return 0;
    }
}
