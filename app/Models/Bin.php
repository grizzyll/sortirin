<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;

    protected $fillable = ['location_id', 'type', 'capacity', 'sensor_status', 'price_per_kg'];

    // TAMBAHKAN INI: Satu Tong Sampah dimiliki oleh satu Lokasi
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}