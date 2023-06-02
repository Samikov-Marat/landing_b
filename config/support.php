<?php

return [
    'shopping_emails' => explode(',', env('SUPPORT_EMAIL_SHOPPING')),
    'forward_emails' => explode(',', env('SUPPORT_EMAIL_FORWARD')),
];
