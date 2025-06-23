<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'do_id',
        'item_id',
        'jumlah'
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function deliveryOrder()
    {
        return $this->belongsTo(DeliveryOrder::class, 'do_id');
    }

}
