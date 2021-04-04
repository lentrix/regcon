<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Convention;
use App\User;
use App\Participant;
use App\Nomination;
use App\Candidate;
use App\Vote;

class ElectionController extends Controller
{
    public function changeState(Request $request) {
        $newState = $request['election_status'];

        $conv = Convention::getActive();
        $conv->election_status = $newState;
        $conv->save();
        return redirect()->back()->with('Info','The Election phase has been changed.');
    }

    public function index() {
        $conv = Convention::getActive();
        $data= ['activeConv'=>$conv];

        if($conv->election_status=="nomination" || $conv->election_status=="election") {
            $nominees = Participant::whereHas('nominations', function($query) use ($conv){
                            $query->where('convention_id', $conv->id);
                        })->whereDoesntHave('candidate', function($query) use ($conv) {
                            $query->where('convention_id', $conv->id);
                        })->get();
            $candidates = Candidate::whereIn('participant_id', Participant::where('convention_id', $conv->id)->select('id'))->get();
            $data =[
                'activeConv' => $conv,
                'nominees' => $nominees,
                'candidates' => $candidates
            ];
        }

        return view('admin.election.index', $data);
    }

    public function home() {
        $conv = Convention::getActive();

        //check participation
        $participant = Participant::where('user_id', auth()->user()->id)
                ->where('convention_id', $conv->id)->first();
        if($participant) {
            return view('elections.index', compact('conv'));
        }else {
            return view('pages.nonparticipant');
        }
    }

    public function searchMember(Request $request) {
        $conv = Convention::getActive();
        $key = $request['searchKey'];
        $users = User::whereHas('participants', function($q1) use ($conv) {
            $q1->where('convention_id', $conv->id);
        })->where(function($q2) use ($key) {
            $q2->where('lname', 'like', "%$key%")
                ->orWhere('fname', 'like', "%$key%");
        })->get();

        return $users;
    }

    public function nominate(Request $request) {
        $conv = Convention::getActive();
        $user = auth()->user();
        if($conv){
            $nominee = Participant::where('user_id', $request['user_id'])
                    ->where('convention_id', $conv->id)->first();
            $nominator = Participant::where('user_id', $user->id)
                    ->where('convention_id', $conv->id)->first();

            $nomination = Nomination::create([
                'nominator' => $nominator->id,
                'nominee' => $nominee->id
            ]);

            $nominator->nominated_at = now();
            $nominator->save();

            return $nomination;
        }
    }

    public function checkNomination() {
        $user = auth()->user();
        $conv = Convention::getActive();

        $participant = Participant::where('user_id', $user->id)
                ->where('convention_id', $conv->id)->first();

        dd($participant);

        $nomination = Nomination::where('nominator', $participant->id)
                ->first();
        if($nomination) {
            $nominee = $nomination->theNominee->user;

            return [
                'nomination'=>$nomination,
                'nominator'=>$user,
                'nominee'=>$nominee
            ];
        }else {
            return null;
        }
    }

    public function nominationResponse(Request $request) {
        $user = auth()->user();
        $part = $user->currentParticipation;
        $part->nomination_response = $request['response'];
        $part->save();

        return redirect()->back()->with('Info','Thank you for responding to your nomination.');
    }

    public function addCandidate(Request $request) {
        $part = Participant::find($request['participant_id']);
        \App\Candidate::create([
            'participant_id' => $part->id,
            'tagline' => ''
        ]);

        return redirect()->back()->with('Info',$part->user->fname . ' has been added to the list of candidates.');
    }

    public function revokeCandidate(Request $request) {
        $cand = Candidate::find($request['candidate_id']);
        $cand->delete();
        return redirect()->back()->with('Info','A candidate has been revoked.');
    }

    public function getCandidates() {
        $conv = Convention::getActive();
        if($conv) {
            $cand = User::join('participants','participants.user_id', 'users.id')
                ->join('conventions','conventions.id', 'participants.convention_id')
                ->join('candidates','candidates.participant_id', 'participants.id')
                ->select([
                    'users.lname', 'users.fname', 'users.designation','users.school',
                    'candidates.participant_id',
                    'candidates.id AS candidate_id'
                ])->get();
            return [
                'candidates' => $cand,
                'numberOfVotes' => $conv->nvotes
            ];
        }else {
            return [];
        }
    }

    public function getVotedAt() {
        $user = auth()->user();
        $part = $user->currentParticipation;
        return $part->voted_at;
    }

    public function submitVote(Request $request) {
        $user = auth()->user();
        $part = $user->currentParticipation;

        foreach($request['votes'] as $vote) {
            Vote::create([
                'participant_id' => $part->id,
                'candidate_id' => $vote['candidate_id']
            ]);
        }

        $part->voted_at = now();
        $part->save();
        return $part->voted_at;
    }

    public function getVotedCandidates() {
        $user = auth()->user();
        $part = $user->currentParticipation;
        $data = [];
        foreach($part->votes as $vote) {
            $user = $vote->candidate->participant->user;
            $data[]=[
                'lname'=>$user->lname,
                'fname'=>$user->fname,
                'designation' => $user->designation,
                'school' => $user->school,
                'candidate_id' => $vote->candidate_id,
                'imgUrl' => $user->imgUrl
            ];
        }
        return $data;
    }
}
