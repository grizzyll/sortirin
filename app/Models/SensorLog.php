<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
protected $table = 'history_sensor';
    protected $fillable = [
        'kategori',
        'kapasitas',
        'status',
    ];
}