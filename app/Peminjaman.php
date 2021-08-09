<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable =['id', 'barang_id', 'nama_pjm', 'nama_brg', 'jml_brg','tgl_pjm', 'tempat_brg', 'keterangan'];

    public function barang (){
        return $this->belongsTo(Barang::class);
    }
}
