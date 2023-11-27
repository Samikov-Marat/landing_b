<?php

namespace App\Classes\Site;

use App\Franchisee;
use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Subdomain
{
    private $franchisee;
    private $subdomain;

    public function __construct(Site $site, string $subdomain)
    {
        $this->subdomain = $subdomain;
        if ('' === $subdomain) {
            $this->franchisee = null;
            return;
        }

        try {
            $this->franchisee = Franchisee::where('subdomain', $subdomain)
                ->firstOrFail();
            $this->franchisee->load('localOffices');
        } catch (ModelNotFoundException $e) {
            abort(HttpFoundationResponse::HTTP_NOT_FOUND);
        }

        foreach ($this->franchisee->localOffices as $localOffice) {
            if ($localOffice->site_id != $site->id) {
                Log::error(
                    'Неправильно прикреплены офисы к франчайзи',
                    [
                        'franchisee' => $this->franchisee->id,
                        'localOffice' => $localOffice->id,
                        'site' => $site->id
                    ]
                );
                abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function hasSubdomain(): bool
    {
        return $this->subdomain != '';
    }

    public function getFranchisee(): Franchisee
    {
        if (is_null($this->franchisee)) {
            abort(HttpFoundationResponse::HTTP_NOT_FOUND);
        }
        return $this->franchisee;
    }

}
