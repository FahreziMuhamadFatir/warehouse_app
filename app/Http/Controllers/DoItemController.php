<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoItem;
use App\Models\DeliveryOrder;
use App\Models\Item;

class DoItemController extends Controller
{
    public function do_detail(DeliveryOrder $do)
    {
        $doItem = DoItem::where('do_id', $do->id)->with('item')->get();
        return view('do_items.do_detail', compact('doItem', 'do'));
    }

    public function create(DeliveryOrder $do)
    {
        // $do = DeliveryOrder::findOrFail($id);
        $doItem = Item::all();
        return view('do_items.create', compact('do', 'doItem'));
    }

    public function store(Request $request, DeliveryOrder $do)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.jumlah' => 'required|integer|min:1'
        ]);

        foreach ($request->items as $item) {
            DoItem::create([
                'do_id' => $do->id,
                'item_id' => $item['item_id'],
                'jumlah' => $item['jumlah']
            ]);
        }
        return redirect()->route('delivery_order.index', ['do'=>$do->id])->with('success', 'Do berhasil ditambahkan.');
    }

    public function show($id){
        $doItem = DoItem::findOrFail($id);
        return view('do_item.show', compact('doItem'));
    }

    public function edit ($id)
    {
        $doItem = DoItem::findOrFail($id);
        return view('do_items.edit', compact('doItem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'do_id' => 'required',
            'item_id' => 'required|exists:items,id',
            'jumlah' => 'required|integer'
        ]);

        $doItem = DoItem::findOrFail($id);
        $doItem->update($request->all());

        return redirect()->route('do_items.detail', ['do' => $doItem->do_id])
                        ->with('success', 'DO item berhasil diupdate.');
    }


    public function destroy($id)
    {
        $doItem = DoItem::findOrFail($id);
        $do_id = $doItem->do_id;
        $doItem->delete();

        return redirect()->route('do_items.detail', ['do' => $doItem->do_id])
                        ->with('success', 'Item berhasil dihapus.');
    }

}
