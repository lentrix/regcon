<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Convention;
use Mail;

class SiteController extends Controller
{
    public function index() {
        if(auth()->guest()) {
            return view('pages.login-form');
        }else {
            return redirect('/dashboard');
        }
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
                Please check your email for verification to complete your registration.
                If you don\'t see your email in your inbox, please check your spam mail.
                Some email servers mistakenly tag our notfication mail as spam.');
    }

    public function sendMailConfirmation($user) {
        Mail::send('emails.email-confirm', ['user'=>$user], function($m) use ($user) {
            $m->from('membership@psite7.org', 'PSITE Regional Convention');
            $m->to($user->email, $user->lname . ", " . $user->fname);
            $m->subject('Email Confirmation');
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

    public function login(Request $request) {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $login = auth()->attempt([
            'email' => $request['email'],
            'password'=>$request['password']
        ]);

        if($login) {
            $user = auth()->user();

            if($user->email_verified_at) {
                return redirect('/dashboard');
            }else {
                auth()->logout();
                return view('pages.unverified-email',['user'=>$user]);
            }

        }else {
            return redirect()->back()->with('Error','Invalid user credentials');
        }
    }

    public function dashboard() {
        $user = auth()->user();
        $convention = Convention::getActive();
        return view('pages.dashboard',[
            'user' => $user,
            'convention' => $convention
        ]);
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function loginForm() {
        return view('pages.login-form');
    }

    public function unauthorized() {
        return view('pages.unauthorized');
    }

    public function forgotPassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request['email'])->first();

        $user->email_token = Str::random(32);
        $user->save();

        Mail::send('emails.forgot', ['user'=>$user], function($m) use ($user) {
            $m->from('membership@psite7.org', 'PSITE Regional Convention');
            $m->to($user->email, $user->lname . ", " . $user->fname);
            $m->subject('Password Recovery');
        });

        return redirect('/')->with('Info',
            'We have sent you a confirmation email with the link
            to change your password. Please check your spam
            if you cannot find the email in your inbox.');
    }

    public function recoverPassword($token) {
        $user=User::where('email_token', $token)->first();
        if(!$user) {
            return redirect('/')->with('Error','Sorry you used an invalid token.');
        }

        return view('pages.change-password', compact('user'));
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::findOrFail($request['user_id']);

        $user->password=bcrypt($request['password']);
        $user->email_token = null;
        $user->save();

        return redirect('/')->with('Info','Your password has been changed successfully! You may login now.');
    }
}
