<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function changeState(Request $request) {
        $newState = $request['election_status'];

        $conv = \App\Convention::where('convention_status','active')->first();
        $conv->election_status = $newState;
        $conv->save();
        return redirect()->back()->with('Info','The Election phase has been changed.');
    }
}
