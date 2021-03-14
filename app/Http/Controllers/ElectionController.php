<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class ElectionController extends Controller
{
    public function index() {

        $phase = config('election.election_phase');
        $voteNum = config('election.candidates_to_vote');

        $user = auth()->user();

        if($phase=='nomination') {
            return view('elections.nomination', compact('user'));
        }else if($phase=="selection") {
            return view('elections.selection', compact('user'));
        }else if($phase=='votation') {
            return view('elections.election', compact('user'));
        }else {
            return view('elections.pending');
        }
    }

}
