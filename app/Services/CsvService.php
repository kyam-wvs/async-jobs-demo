<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CsvUpload;

class CsvService
{
    public function processCsvFiles(int $files): array
    {
        $csvJobs = array_fill(0, $files, []);
        $jobs = array_map(function ($job, $index) use ($files) {
            $timeTaken = rand(1, 20) * 0.1;

            CsvUpload::create([
                'file_name' => "file_" . ($index + 1) . ".csv",
                'data' => json_encode(['sample' => 'data']),
                'job_number' => $index + 1,
            ]);

            usleep((int) $timeTaken * 1000 * 1000); // Simulate processing time

            return ['jobNumber' => $index + 1, 'timeTaken' => $timeTaken];
        }, $csvJobs, array_keys($csvJobs));

        return $jobs;
    }
}
