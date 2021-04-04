<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['user_id','convention_id','role','accepted_by'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function convention() {
        return $this->belongsTo('App\Convention');
    }

    public function nominations() {
        return $this->hasMany('App\Nomination','nominee','id');
    }

    public function candidate() {
        return $this->hasOne('App\Candidate');
    }

    public function votes() {
        return $this->hasMany('App\Vote');
    }
}
