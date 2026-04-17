<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CsvRequest extends Model
{
    protected $fillable = [
        'completed_at',
        'time_taken_ms',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function csvUploads(): HasMany
    {
        return $this->hasMany(CsvUpload::class, 'request_id');
    }
}
