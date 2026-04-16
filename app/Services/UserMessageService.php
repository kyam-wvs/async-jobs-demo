<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserMessage;

class UserMessageService
{
    public function messageUsers(int $users): array
    {
        $userMessages = array_fill(0, $users, []);
        $messages = array_map(function ($message, $index) use ($users) {
            $timeBefore = microtime(true);

            UserMessage::create([
                'message' => "Message for user " . ($index + 1),
                'job_number' => $index + 1,
            ]);
            $timeAfter = microtime(true);
            $timeTaken = $timeAfter - $timeBefore;

            return ['jobNumber' => $index + 1, 'timeTaken' => number_format($timeTaken, 4)];
        }, $userMessages, array_keys($userMessages));

        return $messages;
    }
}
