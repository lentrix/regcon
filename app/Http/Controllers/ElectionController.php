<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class ElectionController extends Controller
{
    public function index() {

        $phase = "nomination";
        $user = auth()->user();

        if($phase=='nomination') {
            return view('elections.nomination', compact('user'));
        }else if($phase=='election') {
            return view('elections.election', compact('user'));
        }else {
            return view('elections.pending');
        }
    }
}
