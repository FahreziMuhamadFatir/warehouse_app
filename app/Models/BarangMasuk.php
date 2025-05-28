<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'item_id', 'jumlah_masuk', 'tanggal_masuk', 'no_surat_jalan', 'keterangan', 'jumlah_per_palet'
    ];

    public function item()
    {
        // return $this->belongsTo(Item::class, 'item_id');
    }
}

