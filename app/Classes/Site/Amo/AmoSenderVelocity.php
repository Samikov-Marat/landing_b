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


class AmoSenderVelocity
{
    private $apiClient;

    const DEFAULT_RESPONSIBLE_USER_ID = 9469758; // Рогожников Сергей Витальевич

    const PIPELINE_ID = 7551790; // Создал для velocity

    public function setApiClient(AmoCRMApiClient $apiClient){
        $this->apiClient = $apiClient;
        return $this;
    }

    public function send($form)
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
        $lead->setName('Заявка из калькулятора cdekvelocity.ru');
        $lead->setPipelineId(self::PIPELINE_ID);
        $responsibleUserId = self::DEFAULT_RESPONSIBLE_USER_ID;
        $lead->setResponsibleUserId($responsibleUserId);
        try {
            $this->apiClient->leads()
                ->addOne($lead);
        } catch (AmoCRMApiException $e) {
            // dd($e);
            Log::error('Не удалось создать сделку в АМО' . $e->getMessage());
            throw new Exception('Не удалось создать сделку в АМО');
        }
    }
}
