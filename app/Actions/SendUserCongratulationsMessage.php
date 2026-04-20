<?php

namespace App\Actions;

class SendUserCongratulationsMessage
{
    public function __invoke()
    {
        var_dump('Congratulations! This is a scheduled message sent every minute.');
    }
}
