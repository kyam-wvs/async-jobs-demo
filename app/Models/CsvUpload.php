<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsvUpload extends Model
{
    protected $fillable = [
        'data',
        'file_name',
        'job_number',
    ];
}
