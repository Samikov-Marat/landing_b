<?php

namespace App\Classes\Admin;

class CertificateChecker
{
    var $domain;

    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    public static function getInstance(string $domain): self
    {
        return new static($domain);
    }

    public function getTimestamp()
    {
        try {
            $params = $this->getParams();
        } catch (\Exception $e) {
            throw new \Exception('Не удалось получить сертификат');
        }
        if (!isset($params['options']['ssl']['peer_certificate'])) {
            throw new \Exception('Неверный формат параметров подключения');
        }
        $certificate = openssl_x509_parse($params['options']['ssl']['peer_certificate']);
        if (!isset($certificate['validTo_time_t'])) {
            throw new \Exception('В сертификате нет даты');
        }
        return $certificate['validTo_time_t'];
    }

    private function getParams()
    {
        $context = stream_context_create(['ssl' => ['verify_peer' => false, 'capture_peer_cert' => true,],]);
        $file = fopen($this->getUrl(), 'rb', false, $context);
        $params = stream_context_get_params($file);
        fclose($file);
        return $params;
    }

    private function getUrl()
    {
        return 'https://' . $this->domain;
    }

}
