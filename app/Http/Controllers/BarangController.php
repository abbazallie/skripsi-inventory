<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Kategori;

class BarangController extends Controller
{
   
    public function index()
    {
        $barang = Barang::with('kategori')->latest()->paginate(6);
        return view('data_barang', compact('barang'))->with('i', (request()->input('page', 1) - 1) * 6);
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('tambah_barang', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'kode_brg' => 'required',
            'nama_brg' => 'required',
            'kategori_id' => 'required',
            'jml_brg'     => 'required|numeric|min:1',
            'tempat_brg'  => 'required',
            'tgl_masuk'   => 'required',
        ],[
            'kode_brg.required' => 'Kode barang harus diisi!',
            'nama_brg.required' => 'Nama barang harus diisi!',
            'kategori_id.required' => 'Kategori barang harus diisi!',
            'jml_brg.required'     => 'Jumlah barang harus diisi!',
            'tempat_brg.required'  => 'Tempat barang harus diisi!',
            'tgl_masuk.required'   => 'Tanggal pencatatan harus diisi!',
        ]);
        $barang = new Barang;
        $barang->kode_brg = $request->kode_brg;
        $barang->nama_brg = $request->nama_brg;
        $barang->kategori_id = $request->kategori_id;
        $barang->jml_brg = $request->jml_brg;
        $barang->tempat_brg = $request->tempat_brg;
        $barang->tgl_masuk = $request->tgl_masuk;
        $barang->save();
        return redirect()->route('barang.create')->with('success', 'Data berhasil ditambah!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        return view('edit_barang', compact('barang','kategori'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        $validation = $request->validate([
            'kode_brg' => 'required',
            'nama_brg' => 'required',
            'kategori_id' => 'required',
            'jml_brg'     => 'required|numeric|min:1',
            'tempat_brg'  => 'required',
            'tgl_masuk'   => 'required',
        ],[
            'kode_brg.required' => 'Kode barang harus diisi!',
            'nama_brg.required' => 'Nama barang harus diisi!',
            'kategori_id.required' => 'Kategori barang harus diisi!',
            'jml_brg.required'     => 'Jumlah barang harus diisi!',
            'tempat_brg.required'  => 'Tempat barang harus diisi!',
            'tgl_masuk.required'   => 'Tanggal pencatatan harus diisi!',
        ]);

        $barang->kode_brg = $request->kode_brg;
        $barang->nama_brg = $request->nama_brg;
        $barang->kategori_id = $request->kategori_id;
        $barang->jml_brg = $request->jml_brg;
        $barang->tempat_brg = $request->tempat_brg;
        $barang->tgl_masuk = $request->tgl_masuk;
        $barang->save();
        return redirect()->route('barang.index')->with('success', 'Data berhasil diedit!');
  
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus');
    }
}
