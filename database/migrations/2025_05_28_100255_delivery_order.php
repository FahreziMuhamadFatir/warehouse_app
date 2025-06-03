<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_do')->unique();
            $table->date('tanggal');
            $table->enum('tujuan', ['Stok', 'Jual', 'dll']);
            $table->enum('status_pengambilan', ['Sudah', 'Belum']->default('Belum'));
            $table->string('keterangan');
            $table->timestamps();
        });     
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};
