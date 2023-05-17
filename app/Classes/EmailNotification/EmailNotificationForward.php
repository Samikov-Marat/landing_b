<?php

namespace App\Classes\EmailNotification;

class EmailNotificationForward extends EmailNotification
{
    const TEMPLATE_FORWARD = 211;

    public function __construct()
    {
        $this->setRecipients(config('support.forward_emails'))
            ->setTemplate(self::TEMPLATE_FORWARD);
    }
}
