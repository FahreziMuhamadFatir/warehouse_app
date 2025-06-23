<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('items', function (Blueprint $table) {
        $table->integer('jumlah_per_palet')->nullable()->after('nama_barang');
    });
}

public function down()
{
    Schema::table('items', function (Blueprint $table) {
        $table->dropColumn('jumlah_per_palet');
    });
}

};
