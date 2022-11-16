<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Carbon;

class UtmCookie
{
    const COOKIE_NAME = 'utm_cookie';
    const UTM_COOKIE_LIFETIME_MINUTES = 10 *
    Carbon::DAYS_PER_YEAR *
    Carbon::HOURS_PER_DAY *
    Carbon::MINUTES_PER_HOUR;

    const SUBDOMAIN_COOKIE_LIFETIME_MINUTES = 30 *
    Carbon::HOURS_PER_DAY *
    Carbon::MINUTES_PER_HOUR;

    var $attributes = [];

    /**
     * @param $json
     * @return static
     * @throws Exception
     */
    public static function getInstanceFromJson($json)
    {
        $decoded = json_decode($json, true);
        if (is_null($decoded)) {
            throw new Exception('Ошибка формата сохранённого utm в cookie');
        }
        return static::getInstance()
            ->setVersion($decoded['version'])
            ->setData($decoded['data']);
    }

    public static function getInstance()
    {
        return new static();
    }

    public function __construct()
    {
        $this->attributes = [
            'version' => 0,
            'data' => [],
        ];
    }

    public function setVersion(int $version)
    {
        $this->attributes['version'] = $version;
        return $this;
    }

    public function getVersion(): int
    {
        return $this->attributes['version'];
    }

    public function setData(array $data): self
    {
        $this->attributes['data'] = $data;
        return $this;
    }

    public function getData()
    {
        return $this->attributes['data'];
    }

    public function isOlderThanVersion(int $version): bool
    {
        return $this->attributes['version'] < $version;
    }

    public function getAsJson()
    {
        return json_encode($this->attributes);
    }
}
