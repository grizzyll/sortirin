<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'date',
        'shift',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}