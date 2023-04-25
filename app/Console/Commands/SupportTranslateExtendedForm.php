<?php

namespace App\Console\Commands;

use App\TextType;
use Illuminate\Console\Command;

class SupportTranslateExtendedForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'support:translate';

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
        $t = '"иврит","he","סוג הזמנה","אחר"
"тайский","th","ประเภทใบแจ้งหนี้","อื่นๆ"
"абхазский","ab","Аҿаҵа атип","Иацу "
"арабский","ar","نوع الطلب","غير ذلك"
"армянский","hy","Պատվերի տեսակ","Այլ "
"вьетнамский","vi","Kiểu đơn hàng","Loại khác"
"грузинский","ka","შეკვეთის ტიპი","სხვა"
"корейский","ko","주문 유형"," 기타"
"немецкий","de","Bestellart","Andere"
"польский","pl","Typ zamówienia","Inne"
"португальский","pt","Tipo de pedido","Outro"
"турецкий","tr","Sipariş türü","Diğer"
"узбекский","uz","Buyurtma turi","Boshqa"
"френч","fr","Type de commande","Autre"
"испанский","es","Tipo de pedido","Otros"
"англ","en","Order type","Other"
"итальянский","it","Tipo di ordine","Altro"
"финский","fi","Tilaustyyppi","Muu"
"азербайджанский","az","Sifariş növü ","Başqalar"';

        $type = [];
        $delivery = [];

        foreach (explode("\n", $t) as $s) {
            $m = str_getcsv($s);
            $type[$m[1]] = $m[2];
            $delivery[$m[1]] = $m[3];
        }


        $textTypes = TextType::whereIn('shortname',
                                       [
                                           'support_form_order_type',
                                           'support_form_order_type_delivery',
                                           'support_form_order_type_shopping',
                                           'support_form_order_type_forward',
                                       ]
        )
            ->with('texts')
            ->get();

        foreach ($textTypes as $textType) {
            if ('support_form_order_type' == $textType->shortname) {
                foreach ($textType->texts as $text) {
                    $text->load('language');
                    if (array_key_exists($text->language->language_code_iso, $type)) {
                        $text->value = $type[$text->language->language_code_iso];
                        $text->save();
                    }
                }
            } elseif ('support_form_order_type_delivery' == $textType->shortname) {
                foreach ($textType->texts as $text) {
                    $text->load('language');
                    if (array_key_exists($text->language->language_code_iso, $delivery)) {
                        $text->value = $delivery[$text->language->language_code_iso];
                        $text->save();
                    }
                }
            } elseif ('support_form_order_type_shopping' == $textType->shortname) {
                foreach ($textType->texts as $text) {
                    $text->load('language');
                    if ('ru' == $text->language->language_code_iso) {
                        $text->value = 'CDEK Shoppng';
                        $text->save();
                    }
                }
            }elseif ('support_form_order_type_forward' == $textType->shortname) {
                foreach ($textType->texts as $text) {
                    $text->load('language');
                    if ('ru' == $text->language->language_code_iso) {
                        $text->value = 'CDEK Forward';
                        $text->save();
                    }
                }
            }
        }


//        'support_form_order_type'
//     'support_form_order_type_delivery'
        return 0;
    }

}
