<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\SmsService;

class SendUserCongratsMessage implements ShouldQueue
{
    use Queueable;

    private $message;

    /**
     * Create a new job instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(SmsService $service): void
    {
        $service->sendSms($this->message);
    }
}
