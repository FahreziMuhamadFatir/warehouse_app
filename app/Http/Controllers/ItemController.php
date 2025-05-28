<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $items = Item::all();
    return view('items.index', compact('items'));
}

public function create()
{
    return view('items.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'category_id' => 'required|integer',
        'kode_barang' => 'required|integer'
    ]);

    Item::create($request->all());

    return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan.');
}

public function show($id)
{
    $item = Item::findOrFail($id);
    return view('items.show', compact('item'));
}

public function edit($id)
{
    $item = Item::findOrFail($id);
    return view('items.edit', compact('item'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'category_id' => 'required|integer',
        'kode_barang' => 'required|integer'
    ]);

    $item = Item::findOrFail($id);
    $item->update($request->all());

    return redirect()->route('items.index')->with('success', 'Item berhasil diupdate.');
}

public function destroy($id)
{
    $item = Item::findOrFail($id);
    $item->delete();

    return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
}

}
