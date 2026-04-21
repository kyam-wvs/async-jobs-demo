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

        // Convert microtime difference to milliseconds
        $diffSeconds = floatval($this->start_microtime) - floatval($this->end_microtime);
        return (int) round($diffSeconds * 1000);
    }
}
