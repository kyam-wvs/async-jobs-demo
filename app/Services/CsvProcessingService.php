<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CsvUpload;
use App\Models\CsvRequest;

class CsvProcessingService
{
    public function processCsv(int $csvId): void
    {
        $upload = CsvUpload::find($csvId);
        if ($upload) {
            // Simulate processing time
            usleep((int) $upload->time_taken_ms * 1000);
            // Update the upload record to indicate it has been processed
            $upload->update(['completed' => true]);
        }
    }
}
