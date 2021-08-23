<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemDamage;
use App\Models\ItemQtyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $damages = ItemDamage::paginate(10);
        return view('damage.index',compact('damages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        return view('damage.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|numeric',
            'amount'  => 'required|numeric|min:0',
            'damage_date' => 'required|date',
            'notes'   => 'sometimes|nullable|string'
        ]);
        $damage = ItemDamage::create($validated);
        ItemQtyHistory::create([
            'item_id'   => $damage->item_id,
            'type'      => 'out',
            'amount'    => $damage->amount,
            'current_stock' => $damage->item->getStock() - $damage->amount
        ]);

        return redirect()->route('damage.index')->with('success','Berhasil menyimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemDamage $damage)
    {
        $items = Item::all();
        return view('damage.edit',compact('damage','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemDamage $damage)
    {
        // Jumlah awal sebelum diedit
        $firstAmount = $damage->amount;

        $validated = $request->validate([
            'item_id' => 'required|numeric',
            'amount'  => 'required|numeric|min:0',
            'damage_date' => 'required|date',
            'notes'   => 'sometimes|nullable|string'
        ]);

        $damage->update($validated);

        if($firstAmount != $validated['amount']) {
            if($validated['amount'] < $firstAmount) {

                // Jika jumlah setelah diedit lebih kecil dari jumlah sebelumnya maka menambah stok barang tsb.
                ItemQtyHistory::create([
                    'item_id'   => $damage->item_id,
                    'type'      => 'in',
                    'amount'    => $firstAmount - $validated['amount'], // mencari selisih stok awal dan baru
                    'current_stock' => $damage->item->getStock() + ($firstAmount - $validated['amount'])
                ]);
            } else {

                // Jika jumlah setelah diedit lebih besar dari jumlah sebelumnya maka mengurangi stok barang tsb.
                ItemQtyHistory::create([
                    'item_id'   => $damage->item_id,
                    'type'      => 'out',
                    'amount'    => $validated['amount'] - $firstAmount, // mencari selisih stok awal dan baru
                    'current_stock' => $damage->item->getStock() - ($validated['amount'] - $firstAmount)
                ]);
            }
        }
        

        return redirect()->route('damage.index')->with('success','Berhasil menyimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $damage = ItemDamage::find($id);
        
        DB::transaction(function () use($damage) {
            ItemQtyHistory::create([
                'item_id' => $damage->id,
                'type'    => 'in',
                'amount'  => $damage->amount,
                'current_stock' => $damage->item->getStock() + $damage->amount
            ]);
    
            $damage->delete();
        });

        return redirect()->route('damage.index')->with('success','Berhasil menghapus');
    }
}
