<?php

namespace App\Classes\Site\Amo;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use Exception;
use Illuminate\Support\Facades\Log;


class AmoSender
{
    private $apiClient;
    private $siteId;

    const responsibleUserIdBySiteId = [
        14 => 8699149 // Видягина Карина
    ];

    public function __construct(AmoCRMApiClient $apiClient, int $siteId = 0)
    {
        $this->apiClient = $apiClient;
        $this->siteId = $siteId;
    }

    public static function getInstance(AmoCRMApiClient $apiClient, int $siteId = 0): self
    {
        return new self($apiClient, $siteId);
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
        $responsibleUserId = array_key_exists($this->siteId, self::responsibleUserIdBySiteId)
            ? self::responsibleUserIdBySiteId[$this->siteId]
            : 7123186;
        $lead->setResponsibleUserId($responsibleUserId);
        try {
            $this->apiClient->leads()
                ->addOne($lead);
        } catch (AmoCRMApiException $e) {
            Log::error('Не удалось создать сделку в АМО' . $e->getMessage());
            throw new Exception('Не удалось создать сделку в АМО');
        }
    }
}
