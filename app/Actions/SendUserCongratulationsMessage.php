<?php

namespace App\Actions;

use App\Services\UserMessageService;

class SendUserCongratulationsMessage
{
    public function __invoke(UserMessageService $service)
    {
        $numberOfUsersToMessage = rand(20, 30);
        $service->messageUsers($numberOfUsersToMessage);

        print_r("Sent congratulations message to " . $numberOfUsersToMessage . " users.\n");
    }
}
