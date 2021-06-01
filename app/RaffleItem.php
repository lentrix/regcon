<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleItem extends Model
{
    protected $fillable = ['convention_id', 'itemName', 'sponsor', 'qty'];

    public function raffleDraws() {
        return $this->hasMany('App\RaffleDraw');
    }

    public function convention() {
        return $this->belongsTo('App\Convention');
    }
}
