<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InItem;
use App\Models\BarangMasuk;
use App\Models\Item;

class InItemController extends Controller
{
    public function in_detail(BarangMasuk $in)
    {
        // Ambil semua InItem yang relasi ke barang_masuk yang ini
        $InItem = $in->inItems()->with('item')->get();

        return view('in_items.detail', compact('InItem', 'in'));
    }

    public function create(BarangMasuk $in)
    {
        // $do = BarangMasuk::findOrFail($id);
        $InItem = Item::all();
        return view('in_items.create', compact('in', 'InItem'));
    }

    public function store(Request $request, BarangMasuk $in)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.jumlah' => 'required|integer|min:1'
        ]);

        foreach ($request->items as $item) {
            InItem::create([
                'in_id' => $in->id,
                'item_id' => $item['item_id'],
                'jumlah' => $item['jumlah']
            ]);
        }
        return redirect()->route('barang_masuk.index', ['in'=>$in->id])->with('success', 'Bongkaran berhasil ditambahkan.');
    }

    public function show($id){
        $InItem = InItem::findOrFail($id);
        return view('in_item.show', compact('InItem'));
    }

    public function edit ($id)
    {
        $InItem = InItem::findOrFail($id);
        return view('in_items.edit', compact('InItem'));
    }

    public function update(Request $request, InItem $in_item)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'jumlah' => 'required|integer|min:1',
    ]);

    $in_item->update([
        'item_id' => $request->item_id,
        'jumlah' => $request->jumlah,
    ]);

    return redirect()->route('in_items.in_detail', ['in' => $in_item->in_id])
                     ->with('success', 'Item berhasil diupdate.');
}


    public function destroy($id)
    {
        $item = InItem::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Item berhasil dihapus');
    }

}
