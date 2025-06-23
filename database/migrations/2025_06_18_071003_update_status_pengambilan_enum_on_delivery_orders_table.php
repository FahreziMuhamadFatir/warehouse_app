<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE delivery_orders MODIFY COLUMN status_pengambilan ENUM('draft', 'out') DEFAULT 'draft'");
    }

    public function down()
    {
        // Balikin ke enum sebelumnya kalau mau, misal:
        DB::statement("ALTER TABLE delivery_orders MODIFY COLUMN status_pengambilan ENUM('masuk', 'keluar') DEFAULT 'masuk'");
    }
};
