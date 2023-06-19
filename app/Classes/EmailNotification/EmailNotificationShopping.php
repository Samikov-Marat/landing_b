<?php

namespace App\Classes\EmailNotification;

class EmailNotificationShopping extends EmailNotification
{
    const TEMPLATE_SHOPPING = 212;

    public function __construct()
    {
        $this->setRecipients(config('support.shopping_emails'))
            ->setTemplate(self::TEMPLATE_SHOPPING);
    }
}
