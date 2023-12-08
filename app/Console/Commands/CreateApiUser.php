<?php

namespace App\Console\Commands;

use App\ApiUser;
use Illuminate\Console\Command;

class CreateApiUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-user:create {name} {password}';

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
        $apiUser = new ApiUser();
        $apiUser->name = $this->argument('name');
        $apiUser->password = $this->argument('password');
        $apiUser->save();
        return 0;
    }
}
