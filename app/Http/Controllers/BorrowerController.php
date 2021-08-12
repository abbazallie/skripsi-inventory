<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Item;
use App\Models\ItemBorrower;
use App\Models\ItemQtyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowers = ItemBorrower::paginate(10);
        return view('borrower.index',compact('borrowers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        return view('borrower.create',compact('items'));
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
            'name'      => 'required|string|max:255',
            'item_id'   => 'required|numeric',
            'amount'    => 'required|numeric|min:0',
            'borrow_date' => 'required|date',
            'notes'     => 'sometimes|nullable'
        ]);
        DB::transaction(function () use($validated) {
            $contact = Contact::create([
                'name'  => $validated['name']
            ]);

            $borrow = ItemBorrower::create([
                'contact_id'    => $contact->id,
                'item_id'       => $validated['item_id'],
                'borrow_date'   => $validated['borrow_date'],
                'amount'        => $validated['amount'],
                'borrow_notes'         => $validated['notes']
            ]);

            ItemQtyHistory::create([
                'item_id'   => $borrow->item_id,
                'type'      => 'out',
                'amount'    => $borrow->amount,
                'current_stock' => $borrow->item->getStock() - $borrow->amount
            ]);
        });

        return redirect()->route('borrower.index')->with('success','Berhasil menyimpan data');
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
    public function edit($id)
    {
        $borrow = ItemBorrower::find($id);
        $items = Item::all();
        return view('borrower.edit',compact('borrow','items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $borrow = ItemBorrower::find($id);
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'item_id'   => 'required|numeric',
            'amount'    => 'required|numeric|min:0',
            'borrow_date' => 'required|date',
            'notes'     => 'sometimes|nullable'
        ]);
        DB::transaction(function () use($validated, $borrow) {
            if($borrow->contact->name != $validated['name']) {
                $contact = Contact::create([
                    'name'  => $validated['name']
                ]);
            } else {
                $contact = $borrow->contact;
            }
            $selisih =  $borrow->amount - $validated['amount'];
            $borrow->update([
                'contact_id'    => $contact->id,
                'item_id'       => $validated['item_id'],
                'borrow_date'   => $validated['borrow_date'],
                'amount'        => $validated['amount'],
                'borrow_notes'  => $validated['notes']
            ]);
            
            if($selisih != 0) {
                if($selisih < 0) {
                    ItemQtyHistory::create([
                        'item_id'   => $borrow->item_id,
                        'type'      => 'out',
                        'amount'    => $selisih * (-1),
                        'current_stock' => $borrow->item->getStock() + $selisih
                    ]);
                } else {
                    ItemQtyHistory::create([
                        'item_id'   => $borrow->item_id,
                        'type'      => 'in',
                        'amount'    => $selisih,
                        'current_stock' => $borrow->item->getStock() + $selisih
                    ]);
                }
            }
            
        });

        return redirect()->route('borrower.index')->with('success','Berhasil menyimpan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrow = ItemBorrower::find($id);
        
        DB::transaction(function () use($borrow) {
            ItemQtyHistory::create([
                'item_id'   => $borrow->item_id,
                'type'      => 'in',
                'amount'    => $borrow->amount,
                'current_stock' => $borrow->item->getStock() + $borrow->amount
            ]);
            $borrow->delete();
        });

        return redirect()->route('borrower.index')->with('success','Berhasil menghapus');

    }
}
