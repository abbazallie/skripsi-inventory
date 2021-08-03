<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = 'barang';
    protected $fillable = ['kode_brg', 'nama_brg','jml_brg', 'tgl_masuk'];
}
