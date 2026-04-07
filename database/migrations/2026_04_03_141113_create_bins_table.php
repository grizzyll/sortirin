<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('bins', function (Blueprint $table) {
        $table->id();
        $table->string('type'); 
        $table->integer('capacity')->default(0); // <--- Pastikan ini ada dan tulisannya benar
        $table->boolean('sensor_status')->default(true);
        $table->decimal('price_per_kg', 10, 2)->default(0);
        $table->timestamps();
    });
}

   
    public function down(): void
    {
        Schema::dropIfExists('bins');
    }
};
