<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');   // organik / anorganik / logam
            $table->integer('kapasitas'); // persentase 0-100
            $table->string('status');     // normal / penuh / error
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensor_logs');
    }
};