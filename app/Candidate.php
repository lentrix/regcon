<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['participant_id', 'tagline'];

    public function participant() {
        return $this->belongsTo('App\Participant');
    }

}
