<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('barang_masuk', function (Blueprint $table) {
        $table->string('no_surat_jalan')->nullable()->after('tanggal_masuk');
    });
}

public function down()
{
    Schema::table('barang_masuk', function (Blueprint $table) {
        $table->dropColumn('no_surat_jalan');
    });
}
};
