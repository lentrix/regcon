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
}
