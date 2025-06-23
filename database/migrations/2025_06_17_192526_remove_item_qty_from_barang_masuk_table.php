<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            // Hapus foreign key constraint dulu
            $table->dropForeign(['item_id']);

            // Baru hapus kolom
            $table->dropColumn(['item_id', 'jumlah_masuk']);
        });
    }

    public function down(): void
    {
        Schema::table('barang_masuk', function (Blueprint $table) {
            // Tambah kolom lagi
            $table->unsignedInteger('item_id')->nullable();
            $table->integer('jumlah_masuk')->nullable();

            // Tambah lagi foreign key-nya
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }
};
