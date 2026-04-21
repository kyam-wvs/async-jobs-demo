<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\SmsService;

class SendUserCongratsMessage implements ShouldQueue
{
    use Queueable;

    private int $messageId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $messageId)
    {
        $this->messageId = $messageId;
    }

    /**
     * Execute the job.
     */
    public function handle(SmsService $service): void
    {
        $service->sendSms("Message for user " . ($this->messageId + 1));
    }
}
