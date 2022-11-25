<?php

namespace App\Classes\Site\Amo;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use Symfony\Component\HttpFoundation\Request;

class AmoSender
{
    private $apiClient;

    public function __construct(AmoCRMApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public static function getInstance(AmoCRMApiClient $apiClient): self
    {
        return new self($apiClient);
    }

    public function send($url, $form)
    {
//Создадим сделку с заполненным полем типа текст
        $lead = new LeadModel();
        $leadCustomFieldsValues = new CustomFieldsValuesCollection();

        foreach ($form as $id => $value) {
            $textCustomFieldValueModel = new TextCustomFieldValuesModel();
            $textCustomFieldValueModel->setFieldId($id);
            $textCustomFieldValueModel->setValues(
                (new TextCustomFieldValueCollection())
                    ->add((new TextCustomFieldValueModel())->setValue($value))
            );
            $leadCustomFieldsValues->add($textCustomFieldValueModel);
        }


        $lead->setCustomFieldsValues($leadCustomFieldsValues);
        $lead->setName('Заявка на сотрудничество ' . $url);
        $lead->setPipelineId(5730658);
        $lead->setResponsibleUserId(7123186);

        try {
            $this->apiClient->leads()
                ->addOne($lead);
        } catch (AmoCRMApiException $e) {
            printError($e);
            die;
        }
    }
}
