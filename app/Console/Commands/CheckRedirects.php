<?php

namespace App\Console\Commands;

use App\Site;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\HttpFoundation\Response;

class CheckRedirects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:redirects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    const DELIM = ',';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    var $fileOutput;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = storage_path('app/admin/chek_redirect.txt');

        $this->fileOutput = fopen($path, 'w');
        foreach (self::getDomains() as $domain) {
            $this->info('Проверка ' . $domain . ' ...');
            sleep(1);
            $this->check('http://', $domain);
            $this->check('http://www.', $domain);
            $this->check('https://www.', $domain);
        }
        fclose($this->fileOutput);
        $this->info('Результат в файле ' . $path);
        return 0;
    }

    private static function getDomains()
    {
        return [
            'bak3.cdek-az.com',
            'cdek.uk',
            'cdek.es',
            'cdek.it',
            'cdek-bg.com',
            'cdek-de.com',
            'cdek-il.com',
            'cdek.fr',
            'rimini.cdek.it',
            'cdek.pt',
            'cdek-ua.com',
            'cdek-usa.com',
            'cdek.com.tr',
            'milano.cdek.it',
            'oberreute.cdek-de.com',
            'palisadespark.cdek-usa.com',
            'cdek-abkhazia.com',
            'cdek.vn',
            'cdek.fi',
            'cdek-ae.com',
            'cdek-az.com',
            'cdek.pl',
            'cdek-express.uz',
            'cdek.kr',
            'cdek-th.com',
            'cdek.ge',
            'los3.cdek-usa.com',
            'sam49.cdek-express.uz'
        ];
    }

    private function check($start, $must)
    {
        $checkedUri = $start . $must;
        $currentString = [];
        $currentString[0] = $checkedUri;
        $currentString[1] = '';
        $currentString[2] = '';
        $currentString[3] = '';
        try {
            $result = Http::withOptions(
                [
                    RequestOptions::ALLOW_REDIRECTS => [
                        'on_redirect' => function (
                            RequestInterface $request,
                            ResponseInterface $response,
                            UriInterface $uri
                        ) use (&$currentString, $must) {
                            $currentString[1] .= $request->getUri() . ' -> ' . $uri . PHP_EOL;
                            $currentString[2] = $uri;
                            $currentString[3] = self::isEqual($uri, $must) ? 'Нормально' : 'Ошибка';
                        }
                    ],
                ]
            )->get($checkedUri);

        } catch (\Exception $e) {
            $currentString[3] = $e->getMessage();
        }
        fputcsv($this->fileOutput, $currentString, self::DELIM);
    }

    private static function isEqual(UriInterface $uri, string $must){
        return ($uri->getScheme() == 'https') &&
            ($uri->getHost() == $must);
    }

}
