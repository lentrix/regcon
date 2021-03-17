<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Config;
use App\User;
use App\Vote;

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
        }else if($phase=="results") {
            return view('elections.results', [
                'results' => $this->getResults()
            ]);
        }else {
            return view('elections.pending');
        }
    }

    private function getResults() {

        $candidates = User::whereHas('candidate')->get();
        $results = [];

        foreach($candidates as $candidate) {
            $results[] = [
                'candidate' => $candidate,
                'count' => Vote::where('candidate_user_id', $candidate->id)->count()
            ];
        }

        $columns = array_column($results, 'count');
        array_multisort($columns, SORT_DESC, $results);

        return $results;
    }

}
