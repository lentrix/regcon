<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convention;
use App\User;
use App\Participant;

class AdminController extends Controller
{
    public function index() {
        $conventions = Convention::all();
        $activeConv = Convention::where('convention_status','active')->first();
        return view('admin.index',[
            'conventions' => $conventions,
            'activeConv' => $activeConv
        ]);
    }

    public function users(Request $request) {
        if(isset($request['search_key'])) {
            $key = $request['search_key'];
            $users = User::where('lname','like',"%$key%")
                    ->orWhere('fname','like',"%$key%")->paginate(20);
        }else {
            $users = User::orderBy('lname')->orderBy('fname')->paginate(20);
        }
        $currentPage = $users->currentPage();
        $lastPage = $users->lastPage();
        $prevPage = $currentPage==1 ? 1 : $currentPage-1;
        $nextPage = $currentPage==$lastPage ? $lastPage : $currentPage+1;

        return view('admin.users', [
            'users'=>$users,
            'currentPage' => $currentPage,
            'prevPage' => $prevPage,
            'nextPage' => $nextPage,
            'lastPage' => $lastPage
        ]);
    }

    public function user(User $user) {
        return view('admin.user', compact('user'));
    }

    public function registerParticipant(Request $request) {
        $user = User::find($request['user_id']);
        $convention = Convention::getActive();
        $adminUser = auth()->user();

        $messageType = 'Info';
        $message="";

        if($convention==null) {
            $message = "Sorry! There is not active convention.";
            $messageType = "Error";
        }

        if($user->participation($convention->id)==null) {
            $p = Participant::create([
                'user_id' => $user->id,
                'convention_id' => $convention->id,
                'role' => $request['role'],
                'accepted_by' => $adminUser->fname . " " . $adminUser->lname
            ]);
            $message = "The user has been registered to the active convention successfully!";
            $messageType = "Info";
        }else {
            $message = "The user is already registered to the active convention.";
        }

        return redirect()->back()->with($messageType, $message);
    }

    public function updateParticipant(Request $request) {
        $participant = Participant::find($request['id']);
        if($participant) {
            $participant->payment_channel = $request['payment_channel'];
            $participant->amount_paid = $request['amount_paid'];
            $participant->save();
        }
        return redirect()->back()->with('Info','Participation details updated.');
    }
}
