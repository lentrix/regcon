<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable=['candidate_id', 'participant_id'];

    public function candidate() {
        return $this->belongsTo('App\Candidate');
    }

    public function participant() {
        return $this->belongsTo('App\Participant');
    }
}
