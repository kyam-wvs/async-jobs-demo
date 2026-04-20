<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CsvUpload;
use App\Models\CsvRequest;
use App\Jobs\ProcessCsv;

class CsvService
{
    public function processCsvBatchAsync(int $files): void
    {
        $this->processCsvBatch($files, true);
    }

    public function processCsvBatchSync(int $files): void
    {
        $this->processCsvBatch($files, false);
    }

    private function processCsvBatch(int $files, bool $asynchronous): void
    {
        $start = microtime(true);
        $record = CsvRequest::create();
        $csvJobs = array_fill(0, $files, []);
        array_map(function ($job, $index) use ($files, $record, $asynchronous) {
            $timeTaken = rand(500, 2000);

            $upload = CsvUpload::create([
                'file_name' => "file_" . ($index + 1) . ".csv",
                'data' => json_encode(['sample' => 'data']),
                'job_number' => $index + 1,
                'request_id' => $record->id,
                'time_taken_ms' => $timeTaken,
            ]);

            if ($asynchronous) {
                ProcessCsv::dispatch($upload->id);
            } else {
                usleep((int) $timeTaken * 1000); // Simulate processing time
                $upload->update(['completed' => true]);
            }
        }, $csvJobs, array_keys($csvJobs));

        $end = microtime(true);

        $record->update(['time_taken_ms' => ($end - $start) * 1000, 'completed' => true]);
    }
}
