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
            $table->foreignId('id_jadwal')->constrained('jadwal_rapats', 'id_jadwal');
            $table->enum('jenis_konsumsi', ['snack', 'nasi', 'snack dan nasi']); // Jenis konsumsi
            $table->decimal('anggaran', 10, 2); // Anggaran
            $table->integer('jumlah'); // Jumlah
            $table->decimal('harga', 10, 2); // Harga
            $table->decimal('pajak', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->virtualAs('jumlah * harga + jumlah * harga * (pajak / 100)'); // Total biaya
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
