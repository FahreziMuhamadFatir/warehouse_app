<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->string('status', 20)->default('draft')->after('jumlah_per_palet');
        });
    }

    public function down(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
