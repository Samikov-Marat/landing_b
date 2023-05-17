<?php

namespace App\Classes\CdekMicroservice\ManageNotifications;

class ManageNotificationResponse
{
    private $apiResponse;

    public function __construct(array $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function getMessageId()
    {
        return $this->apiResponse['messageId'];
    }

}
