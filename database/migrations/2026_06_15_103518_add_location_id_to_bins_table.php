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
        // JIKA KOLOM BELUM ADA, BUAT KOLOM SEKALIGUS FOREIGN KEY-NYA
        if (!Schema::hasColumn('bins', 'location_id')) {
            Schema::table('bins', function (Blueprint $table) {
                $table->unsignedBigInteger('location_id')->nullable()->after('id');
                $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            });
        } else {
            // JIKA KOLOM SUDAH ADA, CUKUP TAMBAHKAN FOREIGN KEY-NYA SAJA (JAGA-JAGA JIKA BELUM TERKONEKSI)
            try {
                Schema::table('bins', function (Blueprint $table) {
                    $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
                });
            } catch (\Exception $e) {
                // Jika foreign key juga sudah ada, biarkan saja agar tidak error
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bins', function (Blueprint $table) {
            // Cek dulu apakah foreign key dan kolomnya ada sebelum dihapus (biar aman saat rollback)
            if (Schema::hasColumn('bins', 'location_id')) {
                try {
                    $table->dropForeign(['location_id']);
                } catch (\Exception $e) {}
                $table->dropColumn('location_id');
            }
        });
    }
};