<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'tanggal_masuk',
        'no_surat_jalan',
        'summary',
        'keterangan',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function inItems()
    {
        return $this->hasMany(InItem::class, 'in_id');
    }
}

