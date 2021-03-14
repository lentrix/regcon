<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lname', 'fname', 'designation', 'school', 'phone', 'email', 'email_token', 'password',
    ];

    protected $appends = ['imgUrl'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'voted_at' => 'datetime'
    ];

    public function getImgUrlAttribute() {

        if(file_exists(public_path('upload/' . $this->id . '.png'))) {
            return asset("upload/$this->id.png");
        }else {
            return asset('upload/default.png');
        }

        // return asset("upload/$this->id.png");

    }

    public function nominations() {
        return $this->hasMany('App\Nomination', 'nominee','id');
    }

    public function nomination() {
        return $this->hasOne('App\Nomination', 'nominator','id');
    }

    public function votes() {
        return $this->hasMany('App\Vote','user_id', 'id');
    }

    public function countVotes() {
        return \App\Vote::where('user_id',$this->id)->count();
    }
}
