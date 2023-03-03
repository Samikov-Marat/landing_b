<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SupportCategory;

class CreateSupportCategoriesGtm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-support_categories_gtm';

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
        $gtms = [
            'Нарушение сроков доставки' => 'lead_time_violation',
            'Возможность доставки' => 'capability_of_delivery',
            'Таможенное оформление' => 'customs_clearance',
            'Пожелания и предложения' => 'wishes_and_suggestions',
            'Претензии' => 'claims',
            'Стоимость и оплата' => "cost_and_payment",
            'Часто задаваемые вопросы' => "faq",
            'Редактирование заказа' => "make_changes_to_the_order",
        ];

        $categories = SupportCategory::query()->where('gtm', null)->get();
        $categories->load('supportCategoryTexts');
        foreach ($categories as $category) {
            foreach ($category->supportCategoryTexts as $supportCategoryText) {
                if (array_key_exists($supportCategoryText->name, $gtms)) {
                    $category->gtm = $gtms[$supportCategoryText->name];
                    $category->save();
                }
            }
        }
    }
}
