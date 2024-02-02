<?php

namespace App\Classes;

use Bunny\Message;
use Cdek\Esb\Contracts\NamedQueueHandlerInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OfficeQueueHandler implements NamedQueueHandlerInterface
{
    public static function queueName(): string
    {
        return 'obj.office';
    }

    public function handle(Message $message): bool
    {
        Log::info($message->content);

        app(OfficeReaderJson::class)
            ->save($message->content);

        return true;
    }
}
