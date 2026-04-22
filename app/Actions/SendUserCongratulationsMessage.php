<?php

namespace App\Actions;

use App\Services\UserMessageService;

class SendUserCongratulationsMessage
{
    public function __invoke(UserMessageService $service)
    {
        $numberOfUsersToMessage = rand(200, 300);
        $service->messageUsers($numberOfUsersToMessage);

        print_r("Sent congratulations message to " . $numberOfUsersToMessage . " users.\n");
    }
}
