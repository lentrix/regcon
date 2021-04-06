<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convention extends Model
{
    protected $fillable = ['title', 'host_school', 'chairman', 'venue', 'schedule', 'theme'];

    public static function getActive() {
        return static::where('convention_status', 'active')->first();
    }

    public function participants() {
        return $this->hasMany('App\Participant');
    }

    public function raffleItems() {
        return $this->hasMany('App\RaffleItem');
    }

    public function electionResults() {
        $candidates = Candidate::whereIn('participant_id', Participant::where('convention_id', $this->id)->select('id'))->get();
        $data = [];
        foreach($candidates as $candidate) {
            $votes = Vote::where('candidate_id', $candidate->id)->count();
            $data[] = [
                'user'  => $candidate->participant->user,
                'votes' => $votes,
                'numOfWinners' => $this->nvotes
            ];
        }

        $votes = array_column($data,'votes');
        array_multisort($votes, SORT_DESC, $data);

        return $data;
    }
}
