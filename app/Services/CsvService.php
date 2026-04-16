<?php

declare(strict_types=1);

namespace App\Services;

class CsvService
{
    public function processCsvFiles(int $files): array
    {
        $csvJobs = array_fill(0, $files, []);
        return array_map(function ($job, $index) use ($files) {
            $timeTaken = rand(1, 20) * 0.1;

            sleep((int) ceil($timeTaken)); // Simulate processing time

            return ['jobNumber' => $index + 1, 'timeTaken' => $timeTaken];
        }, $csvJobs, array_keys($csvJobs));
    }
}
