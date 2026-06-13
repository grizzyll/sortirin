<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'is_active'];

    // TAMBAHKAN INI: Satu Lokasi punya banyak Tong Sampah (Bins)
    public function bins()
    {
        return $this->hasMany(Bin::class);
    }
}