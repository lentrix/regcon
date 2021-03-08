<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request) {
        $this->validate($request,[
            'lname' => 'required',
            'fname' => 'required',
            'school' => 'required',
            'designation' => 'required',
        ]);

        $user->update($request->all());

        return redirect('/')->with('Your profile has been updated.');
    }

    public function changePassword(User $user, Request $request) {
        $this->validate($request, [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user->password = bcrypt($request['password']);
        $user->save();

        return redirect('/')->with("Info", 'Your password has been changed.');
    }
}
