<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserMessage;
use App\Models\UserMessageRequest;

class UserMessageService
{
    public function messageUsers(int $users): array
    {
        $start = microtime(true);
        $record = UserMessageRequest::create();

        $userMessages = array_fill(0, $users, []);
        $messages = array_map(function ($message, $index) use ($users, $record) {
            $timeBefore = microtime(true);

            $message = UserMessage::create([
                'message' => "Message for user " . ($index + 1),
                'job_number' => $index + 1,
                'request_id' => $record->id,
            ]);
        }, $userMessages, array_keys($userMessages));

        $end = microtime(true);
        $record->update(['time_taken_ms' => ($end - $start) * 1000]);

        return $messages;
    }
}
