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
        Schema::create('bongkaran_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bongkaran_id');
            $table->unsignedInteger('item_id');
            $table->integer('qty');

            $table->foreign('bongkaran_id')->references('id')->on('barang_masuk')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bongkaran_detail');
    }
};
