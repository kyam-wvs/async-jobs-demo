<?php

namespace App\Services;

class SmsService
{
    public function sendSms($message)
    {
        usleep(rand(400, 600) * 1000);
        $time = microtime();
        $message->update(['end_microtime' => $time, 'completed' => true]);
        // Simulate sending an SMS by logging the message
        \Log::info("Sending SMS: {$message->message}");

    }
}
