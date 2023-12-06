<?php

namespace App\Classes\Site\Amo;

use Exception;
use Illuminate\Support\Facades\Storage;

class AccessTokenMemento
{
    private $file;

    private $clientSecret;
    private $accessToken;
    private $refreshToken;
    private $expires;

    public function __construct($file)
    {
        $this->file = $file;
        $this->clientSecret = null;
        $this->accessToken = null;
        $this->refreshToken = null;
        $this->expires = null;
    }

    public static function getInstance(): self
    {
        return new static();
    }

    public function exists(): bool
    {
        return Storage::exists($this->file);
    }

    public function load(): self
    {
        if (!$this->exists()) {
            throw new Exception('Access token file not found');
        }
        $accessTokenOptions = json_decode(Storage::get($this->file), true);
        $this->fromArray($accessTokenOptions);
        return $this;
    }

    public function save()
    {
        Storage::put($this->file, json_encode($this->toArray()));
    }

    private function toArray(): array
    {
        return [
            'access_token' => $this->getAccessToken(),
            'client_secret' => $this->getClientSecret(),
            'refresh_token' => $this->getRefreshToken(),
            'expires' => $this->getExpires(),
        ];
    }

    private function fromArray($accessTokenOptions)
    {
        $this->setAccessToken($accessTokenOptions['access_token']);
        $this->setClientSecret($accessTokenOptions['client_secret']);
        $this->setRefreshToken($accessTokenOptions['refresh_token']);
        $this->setExpires($accessTokenOptions['expires']);
    }

    public function getAccessToken(): string
    {
        if (!isset($this->accessToken)) {
            throw new Exception('accessToken не определён');
        }
        return $this->accessToken;
    }

    public function setAccessToken($accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function getClientSecret(): string
    {
        if (!isset($this->clientSecret)) {
            throw new Exception('clientSecret не определён');
        }

        return $this->clientSecret;
    }

    public function setClientSecret($clientSecret): self
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function getRefreshToken(): string
    {
        if (!isset($this->refreshToken)) {
            throw new Exception('refreshToken не определён');
        }
        return $this->refreshToken;
    }

    public function setRefreshToken($refreshToken): self
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    public function getExpires(): string
    {
        if (!isset($this->expires)) {
            throw new Exception('expires не определён');
        }
        return $this->expires;
    }

    public function setExpires($expires): self
    {
        $this->expires = $expires;
        return $this;
    }

}
