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
      Schema::create('sorting_logs', function (Blueprint $table) {
    $table->id();
    $table->string('waste_type'); // Organik, Anorganik, Logam
    $table->float('weight'); // Dalam Kg
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorting_logs');
    }
};
