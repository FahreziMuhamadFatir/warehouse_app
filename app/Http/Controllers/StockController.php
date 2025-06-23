<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stok;
use App\Models\LogStok;
use App\Models\Item;

class StockController extends Controller
{
    public function index()
    {
        $stok = Stok::with('item')->get(); // menampilkan stok saat ini
        $logStok = LogStok::with('item')->latest()->paginate(20); // histori stok masuk & keluar

        return view('stock.index', compact('stok', 'logStok'));
    }
}
