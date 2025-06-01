<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sarpras', function (Blueprint $table) {
            // Mengubah kolom 'total' menjadi kolom virtual dengan ekspresi baru
            $table->integer('total')
                ->virtualAs('jumlah * harga + pajak')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sarpras', function (Blueprint $table) {
            // Mengubah kolom 'total' dengan ekspresi baru
            $table->integer('total')
                ->virtualAs('(jumlah * harga) + pajak')
                ->change();
        });
    }
};
