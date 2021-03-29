<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convention extends Model
{
    protected $fillable = ['title', 'host_school', 'chairman', 'venue', 'schedule', 'theme'];

    public static function getActive() {
        return static::where('convention_status', 'active')->first();
    }
}
