<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Nomination;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;

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
}
