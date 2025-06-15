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
        Schema::table('konsumsis', function (Blueprint $table) {
            // Add a nullable string column for the image path
            $table->string('image_path')->nullable()->after('total');
        });
        Schema::table('sarpras', function (Blueprint $table) {
            // Add a nullable string column for the image path
            $table->string('image_path')->nullable()->after('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konsumsis', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
        Schema::table('sarpras', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
