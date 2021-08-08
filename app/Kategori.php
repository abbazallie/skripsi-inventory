<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey ='id';
    protected $fillable = [
        'id','nama_kategori',   
    ];

    public function barang(){
        return $this->hasMany(Barang::class);
    }
}
