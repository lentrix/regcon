<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['user_id', 'accepted_at', 'tagline'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
