<?php

namespace App\Classes\Site;

use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Subdomain
{
    private $localOffice;

    public function __construct(Site $site, string $subdomain)
    {
        if ('' === $subdomain) {
            $this->localOffice = null;
            return;
        }

        try {
            $this->localOffice = $site->localOffices()
                ->where('subdomain', $subdomain)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(HttpFoundationResponse::HTTP_NOT_FOUND);
        }
    }

    public function hasSubdomain()
    {
        return isset($this->localOffice);
    }

    public function getLocalOffice()
    {
        return $this->localOffice;
    }
}
