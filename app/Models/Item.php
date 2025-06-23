<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi (fillable) lewat mass assignment
    protected $fillable = [
        'nama_barang',
        'jumlah_per_palet',
        'category_id',
        'ketebalan_barang'
    ];
    // protected $guarded = ['id', 'is_admin'];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
