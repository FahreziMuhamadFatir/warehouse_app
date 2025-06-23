<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\InItem;
use App\Models\Stok;
use App\Models\LogStok;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('item')->orderBy('tanggal_masuk', 'desc')->paginate(10);
        return view('barang_masuk.index', compact('barangMasuk'));


    }

    public function create()
    {
        $items = Item::all();  // ambil semua item
        return view('barang_masuk.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'no_surat_jalan' => 'nullable|string',
            'summary' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $in = BarangMasuk::create([
                'tanggal_masuk'   => $request->tanggal_masuk,
                'no_surat_jalan'  => $request->no_surat_jalan,
                'summary'         => $request->summary,
                'keterangan'      => $request->keterangan,
            ]);

            return redirect()->route('in_items.create', ['in' => $in->id])
                ->with('success', 'Bongkaran berhasil ditambahkan. Silakan tambahkan barang.');

        } catch (\Exception $e) {
            dd('Insert gagal: ' . $e->getMessage());
        }
    }


    public function inItems()
    {
        return $this->hasMany(InItem::class, 'in_id');
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
            'tanggal_masuk'     => 'required|date',
            'no_surat_jalan' => 'nullable|string',
            'summary'           => 'nullable|string|max:100',
            'keterangan'        => 'nullable|string',
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

    public function updateStatus($id)
    {
        $barangMasuk = BarangMasuk::with('inItems')->findOrFail($id);

        // Cek jika belum done
        if ($barangMasuk->status !== 'done') {
            foreach ($barangMasuk->inItems as $item) {
                // Tambah stok
                $stok = Stok::firstOrCreate(
                    ['item_id' => $item->item_id],
                    ['stok_total' => 0, 'qty' => 0, 'status' => 'Palet']
                );

                $stok->stok_total += $item->jumlah;
                $stok->qty += $item->jumlah;
                $stok->save();

                // Log stok
                LogStok::create([
                    'item_id' => $item->item_id,
                    'tipe' => 'Masuk',
                    'qty_masuk' => $item->jumlah,
                    'qty_keluar' => null,
                    'stok_akhir' => $stok->stok_total,
                    'tanggal' => now(),
                    'referensi_id' => $barangMasuk->id,
                    'referensi_tabel' => 'Bongkaran',
                    'keterangan' => 'Finalisasi barang masuk ID #' . $barangMasuk->id,
                ]);
            }

            $barangMasuk->status = 'done';
            $barangMasuk->save();

            return redirect()->back()->with('success', 'Status barang masuk telah diperbarui ke DONE dan stok berhasil ditambahkan.');
        }

        return redirect()->back()->with('info', 'Status sudah DONE sebelumnya.');
    }
}
