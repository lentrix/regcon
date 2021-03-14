<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Nomination;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;
use App\Vote;

class ElectionAPIController extends Controller
{
    public function participants($key) {
        return User::where('lname','like',"%$key%")
            ->orWhere('fname','like',"%$key%")
            ->orWhere('school','like',"%$key%")
            ->orderByRaw('lname, fname')->get();
    }

    public function nominate(Request $request) {
        $user = $request->user();
        $nomineeId = $request['participant'];

        $nomination = \App\Nomination::create([
            'nominator' => $user->id,
            'nominee' => $nomineeId
        ]);

        $user->nominated_at = Carbon::now();
        $user->save();

        return $nomination;
    }

    public function checkNominated() {
        $user = auth()->user();
        if($user->nomination)
            return $user->nomination->theNominee;
        else
            return null;
    }

    public function checkPhase() {
        return config('election.election_phase');
    }

    public function getNominees() {
        return User::whereIn('id', Nomination::select('nominee'))
                ->whereNotIn('id', Candidate::select('user_id'))
                ->orderByRaw('lname, fname')
                ->get();
    }

    public function createCandidate(Request $request) {
        $user = auth()->user();
        if($user->role=="moderator" || $user->role=="admin") {
            if($request['id']) {
                $candidate = Candidate::create(['user_id'=>$request['id']]);
                return $candidate;
            }
        }else {
            return ['error'=>'Unauthorized user.'];
        }
    }

    public function getCandidates() {
        return User::whereIn('id', Candidate::select('user_id'))
                ->orderByRaw('lname, fname')
                ->get();
    }

    public function removeCandidate(Request $request) {
        $user = $request->user();

        if($user->role=='admin' || $user->role=='moderator') {
            Candidate::where('user_id', $request['id'])->delete();
            return ['success'=>'Candidate deleted.'];
        }
    }

    public function getMax() {
        return config('election.candidates_to_vote');
    }

    public function getHasVoted() {
        $user = auth()->user();
        return $user->voted_at;
    }

    public function submitVote(Request $request) {
        $user = $request->user();
        $max = $this->getMax();
        foreach($request['votes'] as $voteItem) {

            if($user->countVotes()<3){
                Vote::create([
                    'user_id'=>$user->id,
                    'candidate_user_id' => $voteItem['id']
                ]);
            }

        }
        $user->voted_at = Carbon::now();
        $user->save();
        return ['success'=>'Votes have been saved.'];
    }

    public function getVotedCandidates() {
        $user = auth()->user();
        return User::whereIn('id', Vote::where('user_id', $user->id)->select('candidate_user_id'))->get();
    }
}
