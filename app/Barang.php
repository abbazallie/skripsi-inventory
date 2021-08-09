<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = 'barang';
    protected $primaryKey ='id';
    protected $fillable = ['id','kode_brg', 'nama_brg','jml_brg', 'tgl_masuk', 'kategori_id',];

    public function kategori (){
        return $this->belongsTo(Kategori::class);
    }

    public function barangRusak(){
        return $this->hasOne(BarangRusak::class);
    }

    public function peminjaman(){
        return $this->hasOne(BarangRusak::class);
    }
}
