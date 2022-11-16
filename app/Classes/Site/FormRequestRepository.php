<?php

namespace App\Classes\Site;


use App\Classes\Domain;
use App\Classes\SiteRepository;
use App\FormRequest;
use App\FormRequestField;
use Illuminate\Http\Request;

class FormRequestRepository
{
    private $formName;
    private $siteId;

    public function __construct(string $formName)
    {
        $this->formName = $formName;
    }

    public static function getInstance(string $formName): self
    {
        return new static($formName);
    }


    public function save(Request $request)
    {
        $domain = Domain::getInstance($request);
        $siteRepository = new SiteRepository($domain);
        $site = $siteRepository->getSite();


        $formRequest = new FormRequest();
        $formRequest->form_name = $this->formName;
        $formRequest->submit_url = $request->fullUrl();
        $formRequest->site_id = $site->id;
        $formRequest->save();

        $this->saveFields($request, $formRequest);

    }

    private function saveFields(Request $request, FormRequest $formRequest)
    {
        $fields = [];
        foreach ($request->all() as $name => $value) {
            $formRequestField = new FormRequestField();
            $formRequestField->name = $name;
            $formRequestField->value = $value;
            $fields[] = $formRequestField;
        }
        $formRequest->formRequestFields()->saveMany($fields);
    }
}
