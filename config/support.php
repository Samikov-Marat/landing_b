<?php

return [
    'shopping_email' => explode(',', env('SUPPORT_EMAIL_SHOPPING')),
    'forward_email' => explode(',', env('SUPPORT_EMAIL_FORWARD')),
];
