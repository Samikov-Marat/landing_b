<?php

namespace App\Console\Commands;

use App\Image;
use App\Site;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class CopyImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:copy-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $greatBritain;

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
        $imageUrls = [
            '/docs/poster.jpg',
            '/docs/poster-mobile.jpg',
            '/docs/poster-tablet.jpg',
        ];

        // Для cdek.uk картинки уже загружены
        $this->greatBritain = Site::find(1);
        // Для картинок со страницы документов
        foreach ($imageUrls as $imageUrl) {
            // Получаем все сайты у которых есть страница документов, но нет картинки
            $sites = Site::whereHas('pages', function ($q) {
                $q->where('id', 37);
            })->whereDoesntHave('images', function ($q) use ($imageUrl) {
                $q->where('url', $imageUrl);
            })->get();

            // Загружаем картинку сайта Великобритании cdek.uk
            $image = $this->greatBritain
                ->images()
                ->where('url', $imageUrl)
                ->first();

            $this->processSites($sites, $image);
        }
        return 0;
    }

    private function processSites(Collection $sites, Image $image)
    {
        foreach ($sites as $site) {
            echo $site->id . ' ';
        }

        foreach ($sites as $site) {
            // Копируем картинку в другие сайты
            $imageReplica = $image->replicate(['site_id']);
            $imageReplica->site_id = $site->id;
            $imageReplica->save();
        }
    }

}
