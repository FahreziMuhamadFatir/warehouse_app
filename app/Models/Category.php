<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; //Factory untuk membuat data dummy/sample.
    
    protected $fillable = [
        'name',
        'jenis',
        'kode',
    ];
}
