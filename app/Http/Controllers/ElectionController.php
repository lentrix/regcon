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

    public function index() {
        $conv = \App\Convention::where('convention_status','active')->first();
        return view('admin.election.index', [
            'activeConv' => $conv
        ]);
    }

    public function nomination() {
        $user = auth()->user();
        return view('elections.nomination', compact('user'));
    }

    public function home() {
        $conv = \App\Convention::where('convention_status','active')->first();
        return view('elections.index', compact('conv'));
    }
}
