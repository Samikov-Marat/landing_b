<?php

namespace App\Console\Commands;

use App\TextType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UselessTextTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'useless_text_types:clear';

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

        $files = Storage::disk('views')->allFiles('site');

        $usedTextTypes = collect();

        foreach ($files as $file){
            $contents = Storage::disk('views')->get($file);
            preg_match_all('#\\$dictionary\\[\'(.*?)\'\\]#u', $contents, $m);
            foreach ($m[1] as $shortname){
                $usedTextTypes->push($shortname);
            }
            preg_match_all('#@d\\(\'(.*?)\'\\)#u', $contents, $m);
            foreach ($m[1] as $shortname){
                $usedTextTypes->push($shortname);
            }
        }

        $textTypes = TextType::select('id', 'shortname')->get();
        foreach ($textTypes as $textType){
            if(!$usedTextTypes->contains($textType->shortname)){
                dump($textType->shortname);
            }
        }

//******************************************************
//        Учесть тарифы!!!
//        Перенести в класс, запускать из интерфейса
//******************************************************


        return 0;
    }
}
