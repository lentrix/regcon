<?php

namespace App\Http\Controllers;

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
}
