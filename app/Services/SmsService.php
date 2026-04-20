<?php

namespace App\Services;

class SmsService
{
    public function sendSms($message)
    {
        // Simulate sending an SMS by logging the message
        \Log::info("Sending SMS: {$message}");

        usleep(500 * 1000);
    }
}
