<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable=['user_id', 'candidate_user_id'];

    public function user() {
        return $this->belongsTo('App\User','id', 'user_id');
    }

    public function candidate() {
        return $this->belongsTo('App\User', 'id', 'candidate_user_id');
    }
}
