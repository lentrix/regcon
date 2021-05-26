<?php

namespace App\Http\Controllers;

use App\Convention;
use App\Participant;
use App\Proof;
use App\User;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    public function submitProofOfPayment(Request $request) {
        $this->validate($request, [
            'payment_amount' => 'required|numeric',
            'payment_channel' => 'required|string',
            'file' => 'required'
        ]);

        $user = auth()->user();
        $convention = Convention::getActive();

        $proof = Proof::create([
            'payment_amount' => $request->payment_amount,
            'payment_channel' => $request->payment_channel,
            'user_id' => $user->id,
            'convention_id' => $convention->id
        ]);

        $request->file('file')->move('upload/proofs', $proof->id . '.jpg');

        return redirect('/dashboard')->with('Info','You have successfully uploaded your proof of payment with serial ID# ' . $proof->id);
    }

    public function showProofs() {
        $convention = Convention::getActive();

        $unverified = Proof::where('convention_id', $convention->id)->where('verified',0)->get();
        $verified = Proof::where('convention_id', $convention->id)->where('verified',1)->get();

        return view('admin.proofs.index', [
            'convention' => $convention,
            'unverified' => $unverified,
            'verified' => $verified
        ]);
    }

    public function verifyPayment(Request $request, Proof $proof) {
        $this->validate($request,[
            'user_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'channel' => 'required|string'
        ]);

        $convention = Convention::getActive();
        $user = User::find($request->user_id);

        Participant::create([
            'user_id' => $user->id,
            'convention_id' => $convention->id,
            'amount_paid' => $request->amount,
            'payment_channel' => $request->channel,
            'accepted_by' => auth()->user()->id,
        ]);

        $proof->verified=1;
        $proof->save();

        return redirect('/admin/proofs')->with('Info','The payment of ' . $user->lname . ", " . $user->fname . ' has been validated successfully!');
    }
}
