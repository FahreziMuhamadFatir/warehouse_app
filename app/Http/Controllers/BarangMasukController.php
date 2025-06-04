<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Item;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('item')->orderBy('tanggal_masuk', 'desc')->get();
        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $items = Item::all();  // ambil semua item
        return view('barang_masuk.create', compact('items'));
    }

//     public function store(Request $request)
// {
//     dd($request->all());
// }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'item_id'           => 'required|exists:items,id',
    //         'jumlah_masuk'      => 'required|integer|min:1',
    //         'tanggal_masuk'     => 'required|date',
    //         'summary'           => 'nullable|string|max:100',
    //         'keterangan'        => 'nullable|string',
    //         'jumlah_per_palet'  => 'nullable|integer|min:1',
    //     ]);

    //     BarangMasuk::create($request->all());

    //     return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil disimpan.');
    // }

    public function store(Request $request)
{
    $request->validate([
        'item_id'          => 'required|exists:items,id',
        'jumlah_masuk'     => 'required|integer|min:1',
        'tanggal_masuk'    => 'required|date',
        'no_surat_jalan'   => 'nullable|string|max:255',
        'summary'          => 'nullable|string|max:100',
        'keterangan'       => 'nullable|string',
        'jumlah_per_palet' => 'nullable|integer|min:1',
    ]);

    try {
        BarangMasuk::create($request->only([
            'item_id',
            'jumlah_masuk',
            'tanggal_masuk',
            'no_surat_jalan',
            'summary',
            'keterangan',
            'jumlah_per_palet',
        ]));
        return redirect()->route('barang_masuk.index')->with('success', 'Data berhasil disimpan.');
    } catch (\Exception $e) {
        dd('Insert gagal: ', $e->getMessage());
    }
}


    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $items = Item::all();
        return view('barang_masuk.edit', compact('barangMasuk', 'items'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_id'           => 'required|exists:items,id',
            'jumlah_masuk'      => 'required|integer|min:1',
            'tanggal_masuk'     => 'required|date',
            'summary'           => 'nullable|string|max:100',
            'keterangan'        => 'nullable|string',
            'jumlah_per_palet'  => 'nullable|integer|min:1',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->update($request->all());

        return redirect()->route('barang_masuk.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();

        return redirect()->route('barang_masuk.index')->with('success', 'Data berhasil dihapus.');
    }
}
