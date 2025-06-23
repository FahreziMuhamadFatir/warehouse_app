<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            if (Schema::hasColumn('barang_masuk', 'jumlah_per_palet')) {
                $table->dropColumn('jumlah_per_palet');
            }
        });
    }

    public function down(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            $table->integer('jumlah_per_palet')->nullable();
        });
    }
};
