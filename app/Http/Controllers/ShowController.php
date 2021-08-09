<?php

namespace App\Http\Controllers;

use App\Barang;
use App\BarangRusak;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function show (Request $request){

        $id = $request->id;
        $barang = Barang::find($id);    
      
        return view('form_tampil', compact('barang'));
        
    }

    public function simpan(Request $request, $id){
        dd($id);
        // $validation = $request->validate([
        //     'nama_brg'     => '',
        //     'tempat_brg'     => '',
        //     'jml_brg'     => 'required|numeric|min:1',
        //     'tgl_masuk'   => 'required',
        //     'keterangan'  => 'required',
        // ],[
        //     'jml_brg.required'     => 'Jumlah barang harus diisi!',
        //     'tgl_masuk.required'   => 'Tanggal pencatatan harus diisi!',
        //     'keterangan.required'  => 'Keterangan kerusakan harus diisi!',
        // ]);
        // $barang_rusak = new BarangRusak();
        // $barang_rusak->nama_brg = $request->nama_brg;
        // $barang_rusak->tempat_brg = $request->tempat_brg;
        // $barang_rusak->jml_brg_rsk = $request->jml_brg_rsk;
        // $barang_rusak->tgl_rsk = $request->tgl_rsk;
        // $barang_rusak->keterangan = $request->keterangan;
        // $barang_rusak->save();
        // return redirect()->route('kerusakan.index')->with('success', 'Data berhasil ditambah!');
    }
}
