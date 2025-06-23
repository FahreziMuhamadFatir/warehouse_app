<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStok extends Model
{
    protected $table = 'log_stok';
    protected $fillable = [
        'item_id', 'tipe', 'qty_masuk', 'qty_keluar', 'stok_akhir',
        'tanggal', 'referensi_id', 'referensi_tabel', 'keterangan'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
