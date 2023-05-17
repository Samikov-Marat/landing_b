<?php

namespace App\Classes\CdekMicroservice\ManageNotifications;

class ManageNotificationData
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

    public function getAsArray(): array
    {
        return [
            'recipients' => $this->recipients,
            'templateGroupId' => $this->template,
            'templateParams' => [
                [
                    'key' => 'htmlContent',
                    'value' => $this->htmlContent,
                ],
            ],
            'countryCode' => 1,
        ];
    }
}
