<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\CsvProcessingService;

class ProcessCsv implements ShouldQueue
{
    use Queueable;

    private int $csvUploadId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $csvUploadId)
    {
        $this->csvUploadId = $csvUploadId;
    }

    /**
     * Execute the job.
     */
    public function handle(CsvProcessingService $service): void
    {
        $service->processCsv($this->csvUploadId);
    }
}
