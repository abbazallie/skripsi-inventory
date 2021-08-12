<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $guarded = [];

    public static function boot() {
        parent::boot();
    
    //while creating/inserting item into db  
        static::creating(function ($model) {
            do {
                $code = Carbon::now()->format('dmy').rand(0000,9999);
            } while ( Item::where( 'code', $code )->exists() );

            $model->code =  $code;
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function qty_histories()
    {
        return $this->hasMany(ItemQtyHistory::class);
    }

    public function damages() 
    {
        return $this->hasMany(ItemDamage::class);
    }

    public function borrowers()
    {
        return $this->hasMany(ItemBorrower::class);
    }

    public function place() 
    {
        return $this->belongsTo(Place::class);
    }

    public function getStock()
    {
        return ItemQtyHistory::where('item_id',$this->id)->orderBy('id','desc')->first()->current_stock ?? 0;
    }
}
