<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CsvUpload;
use App\Models\CsvRequest;
use App\Jobs\ProcessCsv;

class CsvService
{
    public function __construct(private CsvProcessingService $processingService)
    {
        $this->processingService = $processingService;
    }

    public function processCsvBatchAsync(int $files): void
    {
        $this->processCsvBatch(
            $files,
            function (int $id) {
                ProcessCsv::dispatch($id);
            }
        );
    }

    public function processCsvBatchSync(int $files): void
    {
        $this->processCsvBatch(
            $files,
            function (int $id) {
                $this->processingService->processCsv($id);
            }
        );
    }

    private function processCsvBatch(int $files, callable $process): void
    {
        $start = microtime(true);
        $record = CsvRequest::create();
        $csvJobs = array_fill(0, $files, []);
        array_map(function ($job, $index) use ($files, $record, $process) {
            $timeTaken = rand(500, 2000);

            $upload = CsvUpload::create([
                'file_name' => "file_" . ($index + 1) . ".csv",
                'data' => json_encode(['sample' => 'data']),
                'job_number' => $index + 1,
                'request_id' => $record->id,
                'time_taken_ms' => $timeTaken,
            ]);

            $process($upload->id);
        }, $csvJobs, array_keys($csvJobs));

        $end = microtime(true);

        $record->update(['time_taken_ms' => ($end - $start) * 1000, 'completed' => true]);
    }
}
