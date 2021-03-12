<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ElectionAPIController extends Controller
{
    public function participants($key) {
        return User::where('lname','like',"%$key%")
            ->orWhere('fname','like',"%$key%")
            ->orWhere('school','like',"%$key%")
            ->orderByRaw('lname, fname')->get();
    }
}
