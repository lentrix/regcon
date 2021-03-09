<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = ['nominator','nominee'];

    public function theNominee() {
        return $this->belongsTo(User::class,'nominee','id');
    }

    public function theNominator() {
        return $this->belongsTo(User::class,'nominator','id');
    }

}
