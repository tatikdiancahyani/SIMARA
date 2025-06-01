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
            // Mengubah kolom 'total' dengan ekspresi baru
            $table->decimal('total', 10, 2)
                  ->virtualAs('(jumlah * harga) + pajak')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sarpras', function (Blueprint $table) {
            // Kembalikan perubahan jika migrasi dibatalkan
            $table->decimal('total', 10, 2)
                  ->virtualAs('(jumlah * harga + pajak)')
                  ->change();
        });
    }
};
