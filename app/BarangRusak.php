<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangRusak extends Model
{
    protected $table ='barang_rusak';
    protected $primaryKey ='id';
    protected $fillable = ['id','barang_id', 'nama_brg_rsk', 'jml_brg_rsk', 'tgl_rsk', 'tempat_brg','keterangan'];

    public function barang (){
        return $this->belongsTo(Barang::class);
    }
}
