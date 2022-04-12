<?php

namespace App\Console\Commands;

use App\TextType;
use Illuminate\Console\Command;

class AddTariffs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tariff:add';

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
        $t = '499,B2B Express,door to door
500,B2B Express,door to warehouse
501,B2B Express,warehouse to door
502,B2B Express,warehouse to warehouse
503,B2B Express,terminal to terminal
647,CDEK Express Document,door to door
648,CDEK Express Document,door to warehouse
649,CDEK Express Document,warehouse to door
650,CDEK Express Document,warehouse to warehouse
651,CDEK Express Document,terminal to terminal
652,CDEK Express Document,дверь-постамат
653,CDEK Express Document,склад-постамат
654,CDEK Express Document,постамат-дверь
655,CDEK Express Document,постамат-склад
656,CDEK Express Document,постамат-постамат
730,B2B Express 200+,terminal to terminal
731,B2B Express 200+,дверь-постамат
732,B2B Express 200+,склад-постамат
733,B2B Express 200+,постамат-дверь
734,B2B Express 200+,постамат-склад
735,B2B Express 200+,постамат-постамат';
$sort = 1200;
        $m = preg_split('#[\n]#', $t);
        foreach ($m as $tariffString) {
            $tariffArray =  preg_split('#,#', $tariffString);

            $t1 = TextType::select('*')
                ->where('shortname' , '_tariff_name_' . $tariffArray[0])
                ->first();
            $t1 =$t1??new TextType();
            $t1->page_id = 16;
            $t1->shortname = '_tariff_name_' . $tariffArray[0];
            $t1->name = 'Новый тариф 2022';
            $t1->default_value = $tariffArray[1];
            $t1->sort = $sort;
            $t1->save();
            $sort += 10;

            $t2 = TextType::select('*')
                    ->where('shortname' , '_tariff_description_' . $tariffArray[0])
                    ->first();
            $t2 =$t2??new TextType();
            $t2->page_id = 16;
            $t2->shortname = '_tariff_description_' . $tariffArray[0];
            $t2->name = 'Новый тариф 2022';
            $t2->default_value = '';
            $t2->sort = $sort;
            $t2->save();
            $sort += 10;

            $t3 = TextType::select('*')
                    ->where('shortname' , '_tariff_type_' . $tariffArray[0])
                    ->first();
            $t3 =$t3??new TextType();
            $t3->page_id = 16;
            $t3->shortname = '_tariff_type_' . $tariffArray[0];
            $t3->default_value = $tariffArray[2];
            $t3->name = 'Новый тариф 2022';
            $t3->sort = $sort;
            $t3->save();
            $sort += 10;

//'_tariff_description_' . $tariffArray[0]
//'_tariff_type_' . $tariffArray[0]

            }
        return 0;
    }
}
