<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserMessageRequest extends Model
{
    protected $fillable = [
        'time_taken_ms',
        'completed',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(UserMessage::class, 'request_id');
    }
}
