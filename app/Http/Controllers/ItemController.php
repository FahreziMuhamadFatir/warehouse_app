<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('category')->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all(); //manggl seluruh category
        // $items = Item::all(); //di komen karena saat ini blm perlu
        return view('items.create', compact('categories')); //mengirim data items dan categories ke view create
    }

public function store(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jumlah_per_palet' => 'nullable|integer|min:1',
        'category_id' => 'required|integer',
        'ketebalan_barang' => 'required|integer'
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
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jumlah_per_palet' => 'nullable|integer|min:1',
        'category_id' => 'required|integer',
        'ketebalan_barang' => 'required|integer'
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
