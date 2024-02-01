<?php

namespace App\Classes;

use Bunny\Message;
use Cdek\Esb\Contracts\NamedQueueHandlerInterface;
use Illuminate\Support\Facades\Storage;

class OfficeQueueHandler implements NamedQueueHandlerInterface
{
    public static function queueName(): string
    {
        return 'obj.office';
    }

    public function handle(Message $message): bool
    {
        Storage::append('esb_log.txt', var_export($message), true);
    }
}
