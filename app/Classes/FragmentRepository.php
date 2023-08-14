<?php

namespace App\Classes;

use App\Classes\Site\Subdomain;
use Illuminate\Database\Eloquent\Collection;

class FragmentRepository
{
    private $fragment;
    private $subdomain;

    public function __construct(Collection $fragment)
    {
        $this->fragment = $fragment;
    }

    public function forSubdomain(Subdomain $subdomain)
    {
        $this->subdomain = $subdomain;
        return $this;
    }

    public function getWithTexts($language)
    {
        $load = [
            'textTypes' => function ($query) {
                $query->select('id', 'page_id', 'shortname');
            },
            'textTypes.texts' => function ($query) use ($language) {
                $query->select('id', 'text_type_id', 'value')
                    ->where('language_id', $language->id);
            }
        ];
        if ($this->subdomain->hasSubdomain()) {
            $franchisee = $this->subdomain->getFranchisee();
            $load['textTypes.franchiseeTexts'] =
                function ($query) use ($language, $franchisee) {
                    $query->select('id', 'text_type_id', 'value')
                        ->where('language_id', $language->id)
                        ->where('franchisee_id', $franchisee->id);
                };
        }
        return $this->fragment->load($load);
    }

}
