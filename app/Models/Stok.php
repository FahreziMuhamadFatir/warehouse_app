<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';
    protected $fillable = ['item_id', 'stok_total', 'qty', 'status'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
