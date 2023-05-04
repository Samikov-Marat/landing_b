<?php

namespace App\Classes\Site;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\Redis;

class Metrics
{
    private $registry;

    public function __construct($config)
    {
        $options = [
            'host' => $config['host'],
            'port' => $config['port'],
            'password' => $config['password'],
        ];

        $this->registry = new CollectorRegistry(new Redis($options));
    }

    public function showPage()
    {
        $this->registry->getOrRegisterCounter('', 'show_page', 'Показ страницы')
            ->inc();
    }

    public function render(): string
    {
        $renderer = new RenderTextFormat();
        return $renderer->render(
            $this->registry->getMetricFamilySamples()
        );
    }

    public function getMimeType(): string
    {
        return RenderTextFormat::MIME_TYPE;
    }

}
