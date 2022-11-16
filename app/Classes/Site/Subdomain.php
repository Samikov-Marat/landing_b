<?php

namespace App\Classes\Site;

use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

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
            abort(Response::HTTP_NOT_FOUND);
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
