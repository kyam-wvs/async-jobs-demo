<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserMessage;
use App\Models\UserMessageRequest;
use App\Services\SmsService;
use App\Jobs\SendUserCongratsMessage;

class UserMessageService
{
    public function __construct(private SmsService $smsService)
    {}

    public function messageUsers(int $users): void
    {
        $start = microtime(true);
        $record = UserMessageRequest::create();

        $userMessages = array_fill(0, $users, []);
        array_map(function ($message, $index) use ($users, $record) {
            $timeBefore = microtime(true);

            $message = UserMessage::create([
                'message' => "Message for user " . ($index + 1),
                'job_number' => $index + 1,
                'request_id' => $record->id,
                'completed' => true,
            ]);

            SendUserCongratsMessage::dispatch($message->id);
        }, $userMessages, array_keys($userMessages));

        $end = microtime(true);
        $record->update(['time_taken_ms' => ($end - $start) * 1000, 'completed' => true]);
    }
}
