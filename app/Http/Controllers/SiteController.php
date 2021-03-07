<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Mail;

class SiteController extends Controller
{
    public function index() {
        return view('pages.login-form');
    }

    public function regForm() {
        return view('pages.registration');
    }

    public function register(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'lname'=> 'required',
            'lname'=> 'required',
            'school'=> 'required',
            'designation'=> 'required',
            'password'=> 'required|confirmed',
        ]);

        $user = User::create([
            'email' => $request['email'],
            'lname' => $request['lname'],
            'fname' => $request['fname'],
            'school' => $request['school'],
            'designation' => $request['designation'],
            'phone' => $request['phone'],
            'email_token' => Str::random(40),
            'password' => bcrypt($request['password'])
        ]);

        $this->sendMailConfirmation($user);

        return redirect('/')->with('Info','The registration has been submitted.
                Please check your email for verification to complete your registration.');
    }

    public function sendMailConfirmation($user) {
        Mail::send('emails.email-confirm', ['user'=>$user], function($m) use ($user) {
            $m->from('membership@psite7.org', 'PSITE Regional Convention');
            $m->to($user->email, $user->lname . ", " . $user->fname);
        });
    }

    public function confirmEmail(User $user, $token) {
        if($user->email_token = $token) {
            $user->email_verified_at = now();
            $user->save();
            return redirect('/')->with('Info','Email has been verified. You may proceed to login. Thank you!');
        }else {
            return view('/pages/invalid-token');
        }
    }
}
