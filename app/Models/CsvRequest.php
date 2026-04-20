<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CsvRequest extends Model
{
    protected $fillable = [
        'time_taken_ms',
        'request_id',
        'completed',
    ];

    public function csvUploads(): HasMany
    {
        return $this->hasMany(CsvUpload::class, 'request_id');
    }
}
