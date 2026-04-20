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
    ];
}
