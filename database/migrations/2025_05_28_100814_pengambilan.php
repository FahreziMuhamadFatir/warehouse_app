<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengambilan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('do_item_id');
            $table->enum('status_pengambilan', ['Sudah', 'Belum']);
            $table->text('catatan')->nullable();

            $table->foreign('do_item_id')->references('id')->on('do_items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengambilan');
    }
};
