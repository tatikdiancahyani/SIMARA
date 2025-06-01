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
        Schema::create('sarpras', function (Blueprint $table) {
            $table->id('id_sarpras'); 
            $table->foreignId('id_jadwal')->constrained('jadwal_rapats');
            $table->string('nama_sarpras'); // Nama sarana/prasarana
            $table->integer('jumlah')->default(0); // Jumlah sarana/prasarana
            $table->decimal('anggaran', 10, 2); // Anggaran untuk sarana/prasarana
            $table->decimal('harga', 10, 2); // Harga per unit
            $table->decimal('pajak', 10, 2)->default(0); // Pajak, default 0
            $table->decimal('total', 10, 2)->virtualAs('(jumlah * harga + pajak)'); // Total biaya
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarpras');
    }
};
