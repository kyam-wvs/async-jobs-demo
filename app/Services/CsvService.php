<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CsvUpload;
use App\Models\CsvRequest;

class CsvService
{
    public function processCsvFiles(int $files): void
    {
        $start = microtime(true);
        $record = CsvRequest::create();
        $csvJobs = array_fill(0, $files, []);
        array_map(function ($job, $index) use ($files, $record) {
            $timeTaken = rand(500, 2000);

            $upload = CsvUpload::create([
                'file_name' => "file_" . ($index + 1) . ".csv",
                'data' => json_encode(['sample' => 'data']),
                'job_number' => $index + 1,
                'request_id' => $record->id,
                'time_taken_ms' => $timeTaken,
            ]);

            usleep((int) $timeTaken * 1000); // Simulate processing time
            $upload->update(['completed' => true]);
        }, $csvJobs, array_keys($csvJobs));

        $end = microtime(true);

        $record->update(['time_taken_ms' => ($end - $start) * 1000, 'completed' => true]);
    }
}
