<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemBorrower extends Model
{
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
