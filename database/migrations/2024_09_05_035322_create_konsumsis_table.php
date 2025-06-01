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
        Schema::create('konsumsis', function (Blueprint $table) {
            $table->id('id_konsumsi');
            $table->foreignId('id_jadwal')->constrained('jadwal_rapats');
            $table->enum('jenis_konsumsi', ['snack', 'nasi', 'snack dan nasi']); // Jenis konsumsi
            $table->decimal('anggaran', 10, 2); // Anggaran
            $table->integer('jumlah'); // Jumlah
            $table->decimal('pajak', 10, 2)->default(0);
            $table->decimal('total', 10, 2); // Total
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsumsis');
    }
};
