<?php


namespace App\Classes;


use App\Classes\Site\Subdomain;

class FragmentRepository
{
    private $fragment;
    /**
     * @var Subdomain
     */
    private $subdomain;


    public function __construct($fragment)
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
        if ($this->subdomain->hasSubdomain()) {
            $franchisee = $this->subdomain->getFranchisee();
            $this->fragment->load(
                [
                    'textTypes.franchiseeTexts' => function ($query) use ($language, $franchisee) {
                        $query->select('id', 'text_type_id', 'value')
                            ->where('language_id', $language->id)
                            ->where('franchisee_id', $franchisee->id);
                    }
                ]
            );
        }

        return $this->fragment->load(
            [
                'textTypes' => function ($query) {
                    $query->select('id', 'page_id', 'shortname');
                }
            ]
        )->load(
            [
                'textTypes.texts' => function ($query) use ($language) {
                    $query->select('id', 'text_type_id', 'value')
                        ->where('language_id', $language->id);
                }
            ]
        );
    }

}
