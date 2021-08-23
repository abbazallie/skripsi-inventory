<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemQtyHistory;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Item::with('category')->latest()->paginate(6);
        return view('item.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('item.create', compact('categories'));
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
            'name' => 'required|string|max:255',
            'category_id'   => 'required|numeric',
            'amount'    => 'required|numeric|min:0',
            'place_id'  => 'required|string',
            'date_in'   => 'required'
        ]);

        DB::transaction(function () use($validated){
            $placeId = $validated['place_id'];
            if(!is_numeric($validated['place_id'])) {
                $place = Place::create([
                    'name'  => $validated['place_id']
                ]);

                $placeId = $place->id;
            }

            $item = Item::create([
                'name'  => $validated['name'],
                'category_id' => $validated['category_id'],
                'place_id' => $placeId,
                'date_in'   => $validated['date_in']
            ]);

            ItemQtyHistory::create([
                'item_id'   => $item->id,
                'amount'    => $validated['amount'],
                'type'      => 'in',
                'current_stock' => $item->getStock() + $validated['amount']
            ]);
        });

        return redirect()->route('item.index')->with('succes','Berhasil menyimpan data');

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
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('item.edit',compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id'   => 'required|numeric',
            'amount'    => 'required|numeric|min:0',
            'place_id'  => 'required|string',
            'date_in'   => 'required'
        ]);

        DB::transaction(function () use($validated, $item){
            $placeId = $validated['place_id'];
            if(!is_numeric($validated['place_id'])) {
                $place = Place::create([
                    'name'  => $validated['place_id']
                ]);

                $placeId = $place->id;
            }

            $item->update([
                'name'  => $validated['name'],
                'category_id' => $validated['category_id'],
                'place_id' => $placeId,
                'date_in'   => $validated['date_in']
            ]);

            $newStock = $validated['amount'] - $item->getStock();
            if($newStock != 0) {
                if($validated['amount'] < $item->getStock()) {
                    $type = 'out';
                    if($newStock < 0) {
                        $amount = $validated['amount'] * (-1);
                    } else {
                        $amount = $validated['amount'];
                    }
                    
                    // $current_stock = $validated['amount'];
                } else {
                    $type = 'in';
                    $amount = $validated['amount'] - $item->getStock();
                    // $current_stock = $validated['amount'];
                }
                ItemQtyHistory::create([
                    'item_id'   => $item->id,
                    'amount'    => $amount,
                    'type'      => $type,
                    'current_stock' => $validated['amount']
                ]);
            }

            
        });

        return redirect()->route('item.index')->with('succes','Berhasil menyimpan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus item');
    }
}
