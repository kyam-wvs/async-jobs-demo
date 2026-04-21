<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $attributes = [
        'message' => '',
    ];

    protected $fillable = [
        'message',
        'job_number',
        'request_id',
        'completed',
        'start_microtime',
        'end_microtime',
    ];

    public function getTimeTakenMs(): ?int
    {
        if (!$this->end_microtime || !$this->start_microtime) {
            return null;
        }

        // Parse microtime format: "microseconds seconds" to float timestamp
        $start = $this->parseMicrotime($this->start_microtime);
        $end = $this->parseMicrotime($this->end_microtime);

        if ($start === null || $end === null) {
            return null;
        }

        $diffSeconds = abs($end - $start);
        return (int) round($diffSeconds * 1000);
    }

    private function parseMicrotime(?string $microtime): ?float
    {
        if (!$microtime) {
            return null;
        }

        // microtime format is "0.12345600 1234567890"
        // Convert to float timestamp
        $parts = explode(' ', trim($microtime));
        if (count($parts) === 2) {
            return floatval($parts[1]) + floatval($parts[0]);
        }

        return floatval($microtime);
    }
}
