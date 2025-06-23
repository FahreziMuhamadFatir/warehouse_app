<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'in_id',
        'item_id',
        'jumlah'
    ];

    // Relasi ke tabel barang_masuk
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'in_id');
    }

    // Relasi ke tabel items
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
