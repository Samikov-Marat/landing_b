<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitReceive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:receive';

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
        $connection = new AMQPStreamConnection('rabbit', '5672', 'test_sender', 'senderpass');
        $channel = $connection->channel();
        $channel->queue_declare('test_send', false, false, false, false);

        $channel->basic_consume('test_send', '', false, true, false, false, function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        });

        try {
            $channel->wait();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }

        return 0;
    }
}
