<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleDraw extends Model
{
    protected $fillable = ['raffle_item_id', 'participant_id'];

    public function participant() {
        return $this->belongsTo('App\Participant');
    }

    public function raffleItem() {
        return $this->belongsTo('App\RaffleItem');
    }
}
