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

    protected $appends = ['imgUrl'];

    public function getImgUrlAttribute() {

        if(file_exists(public_path('upload/' . $this->id . '.png'))) {
            return asset("upload/$this->id.png");
        }else {
            return asset('upload/default.png');
        }

        // return asset("upload/$this->id.png");

    }

    public function participation($conventionId) {
        $p = Participant::where('user_id',$this->id)
                ->where('convention_id', $conventionId)->first();
        return $p;
    }

    public function getCurrentParticipationAttribute() {
        $conv = Convention::getActive();
        return $conv ? $this->participation($conv->id) : null;
    }

    public function participants() {
        return $this->hasMany('App\Participant');
    }


}
