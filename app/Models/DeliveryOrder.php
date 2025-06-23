<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_do',
        'tanggal',
        'tujuan',
        'status_pengambilan',
        'keterangan',
    ];

    public function doItems () {
        return $this->hasMany(DoItem::class, 'do_id');
    }
}
