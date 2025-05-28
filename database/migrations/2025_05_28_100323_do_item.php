<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('do_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('do_id');
            $table->unsignedInteger('item_id');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('do_id')->references('id')->on('delivery_orders')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('do_items');
    }
};
