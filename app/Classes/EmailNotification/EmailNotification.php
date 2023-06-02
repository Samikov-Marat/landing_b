<?php

namespace App\Classes\EmailNotification;

use App\Classes\CdekMicroservice\ManageNotifications\ManageNotificationData;
use App\Classes\CdekMicroservice\ManageNotifications\ManageNotifications;
use App\Classes\CdekMicroservice\Pdp\SimpleAuthentication;

class EmailNotification
{
    private $recipients;
    private $template;
    private $htmlContent;

    public static function getInstance(): self
    {
        return new static();
    }

    public function setRecipients(array $recipients): self
    {
        $this->recipients = $recipients;
        return $this;
    }

    public function setTemplate(int $template): self
    {
        $this->template = $template;
        return $this;
    }

    public function setHtmlContent(string $htmlContent): self
    {
        $this->htmlContent = $htmlContent;
        return $this;
    }

    public function send()
    {
        $token = SimpleAuthentication::getInstance()
            ->authorize()
            ->getToken();
        $configuration = ManageNotificationData::getInstance()
            ->setRecipients($this->recipients)
            ->setTemplate($this->template)
            ->setHtmlContent($this->htmlContent);
        return ManageNotifications::getInstance()
            ->setToken($token)
            ->send($configuration)
            ->getMessageId();
    }

}
