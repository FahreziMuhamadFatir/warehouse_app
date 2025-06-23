<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\Stok;
use App\Models\LogStok;

class DeliveryOrderController extends Controller
{
     public function index()
    {
        $deliveryOrder = DeliveryOrder::paginate(10);
        return view('delivery_order.index', compact('deliveryOrder'));
    }

    public function create()
    {
        $deliveryOrder = DeliveryOrder::all();
        // $items = Item::all(); //di komen karena saat ini blm perlu
        return view('delivery_order.create'); //mengirim data items dan categories ke view create
    }

    public function store(Request $request)
    {
    $request->validate([
        'no_do' => 'required|string|unique:delivery_orders,no_do',
        'tanggal' => 'required|date',
        'tujuan' => 'required|in:Stok,Jual,dll',
        // 'status_pengambilan' => 'required|in:Sudah, Belum',
        'keterangan' => 'nullable|string|max:255'
    ]);

        $do = DeliveryOrder::create($request->all());

        return redirect()->route('do_items.create', ['do'=>$do->id])->with('success', 'DO berhasil ditambahkan. Silakan tambahkan barang.');
    }

    public function show($id)
    {
        $deliveryOrder = DeliveryOrder::findOrFail($id);
        return view('delivery_order.show', compact('deliveryOrder'));
    }

    public function edit($id)
    {
        $deliveryOrder = DeliveryOrder::findOrFail($id);
        return view('delivery_order.edit', compact('deliveryOrder'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_do' => 'required|string|unique:delivery_orders,no_do,' .$id,
            'tanggal' => 'required|date',
            'tujuan' => 'required|in:Stok,Jual,dll',
            'keterangan' => 'nullable|string|max:255'
        ]);

            $deliveryOrder = DeliveryOrder::findOrFail($id);
            $deliveryOrder->update($request->all());

            return redirect()->route('delivery_order.index')->with('success', 'DO berhasil diupdate.');
    }

    public function destroy($id)
    {
        $deliveryOrder = DeliveryOrder::findOrFail($id);
        $deliveryOrder->delete();

        return redirect()->route('delivery_order.index')->with('success', 'DO berhasil dihapus.');
    }

    public function updateStatus($id)
    {
        $do = DeliveryOrder::with('doItems')->findOrFail($id);

        if ($do->status_pengambilan !== 'out') {
            foreach ($do->doItems as $item) {
                $stok = Stok::where('item_id', $item->item_id)->first();
                if ($stok && $stok->stok_total >= $item->jumlah) {
                    $stok->stok_total -= $item->jumlah;
                    $stok->qty -= $item->jumlah;
                    $stok->save();

                    LogStok::create([
                        'item_id' => $item->item_id,
                        'tipe' => 'Keluar',
                        'qty_keluar' => $item->jumlah,
                        'qty_masuk' => null,
                        'stok_akhir' => $stok->stok_total,
                        'tanggal' => now(),
                        'referensi_id' => $do->id,
                        'referensi_tabel' => 'Jual',
                        'keterangan' => 'Pengeluaran DO #' . $do->id,
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Stok tidak cukup untuk item ' . $item->items->nama_barang);
                }
            }

            $do->status_pengambilan = 'out';
            $do->save();

            return redirect()->back()->with('success', 'Status diubah ke OUT & stok dikurangi.');
        }

        return redirect()->back()->with('info', 'Status sudah OUT.');
    }
}
