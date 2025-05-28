<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_stok', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->enum('tipe', ['Masuk', 'Keluar']);
            $table->integer('jumlah');
            $table->integer('stok_akhir');
            $table->dateTime('tanggal')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('referensi_id')->nullable();
            $table->enum('referensi_tabel', ['barang_masuk', 'do_items'])->nullable();
            $table->text('keterangan')->nullable();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_stok');
    }
};
