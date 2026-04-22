<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;

    // Tambahkan baris ini!
    protected $fillable = ['type', 'capacity', 'sensor_status', 'price_per_kg'];
}