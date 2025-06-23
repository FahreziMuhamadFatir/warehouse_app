<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('in_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('in_id');
            $table->unsignedInteger('item_id');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('in_id')->references('id')->on('barang_masuk')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('in_items');
    }
};
