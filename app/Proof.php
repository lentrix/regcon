<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $fillable = ['payment_amount','payment_channel','user_id','convention_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function covention(){
        return $this->belongsTo('App\Covention');
    }
}
