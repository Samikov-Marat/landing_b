<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ParseNewTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_template:parse';

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
        $contents = file_get_contents(base_path('resources/views/site/personal/index.html'));
//        $matches = [];
//        preg_match_all('#>\s*(.*?)\s*<#ums', $contents, $matches);
//        $cleared = [];
//        foreach ($matches[1] as $phrase) {
//            $clearedPhrase = trim($phrase);
//            if (!empty($clearedPhrase)) {
//                $cleared[] = $clearedPhrase;
//            }
//        }


        $textTypes = [];

        $translated = preg_replace_callback(
            '#(?<=>)[^<]*?(?=<)#ums',
            function ($matches) use (&$textTypes) {
                static $id = 1;
                if ('' === trim($matches[0])) {
                    return $matches[0];
                }
                $shortname = 'personal_' . $id;

                $replaceRegularExpression = '#^(\s*)(.*?)(\s*)$#ums';

                $textTypes[] = [
                    'page_id' => 23,
                    'shortname' => $shortname,
                    'name' => '',
                    'default_value' => preg_replace($replaceRegularExpression, '$2', $matches[0]),
                    'sort' => $id * 10,
                    'created_at' => '2021-07-08 20:00:00',
                    'updated_at' => '2021-07-08 20:00:00',
                ];
                $insert = '@d(\'' . $shortname . '\')';
                $id++;
                return preg_replace($replaceRegularExpression, '$1' . $insert . '$3', $matches[0]);
//                $clearedPhrase = trim($phrase);
//                if (!empty($clearedPhrase)) {
//                    $cleared[] = $clearedPhrase;
//                }
            },
            $contents
        );
        file_put_contents(base_path('resources/views/site/personal/index.blade.php'), $translated);

        $csvHandler = fopen(base_path('resources/views/site/personal/text_types.csv'), 'w');
        fputcsv($csvHandler, array_keys($textTypes[0]));
        foreach ($textTypes as $textType){
            fputcsv($csvHandler, $textType);
        }
        fclose($csvHandler);

        return 0;
    }
}
