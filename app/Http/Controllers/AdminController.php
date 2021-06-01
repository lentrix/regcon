<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convention;
use App\User;
use App\Participant;
use Illuminate\Support\Facades\Mail;

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
                    ->orWhere('fname','like',"%$key%")
                    ->orWhere('school','like',"%$key%")
                    ->paginate(20);
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
            'lastPage' => $lastPage,
            'stats' => User::stats()
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
            $message = "Sorry! There is no active convention.";
            $messageType = "Error";
        }

        if(!$user->participation($convention->id)) {
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

    public function bulkMail() {
        return view('admin.bulkmail');
    }

    public function sendBulkMail(Request $request) {
        $this->validate($request, [
            'recipient' => 'required',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        $recipients = null;

        $convention = Convention::getActive();

        if($request->recipients=="all") {
            $recipients = User::get();
        } else if ($request->recipients=="nonparticipants") {
            $recipients = User::whereNotIn('id', Participant::where('convention_id', $convention->id)->select(['user_id']))->get();
        }else {
            $recipients = User::whereIn('id', Participant::where('convention_id', $convention->id)->select(['user_id']))->get();
        }

        foreach($recipients as $user) {
            Mail::send('emails.bulk-mail', ['user'=>$user, 'body'=>$request['message']],
                    function($m) use ($user, $request) {
                        $m->from('membership@psite7.org', 'PSITE Regional Convention');
                        $m->to($user->email, $user->lname . ", " . $user->fname);
                        $m->subject($request->subject);
                    });
        }

        return redirect('/admin')->with('Info','Bulk mails have been sent.');
    }

    public function downloadParticipants() {
        $conv = Convention::getActive();

        $headers = [
            "Content-type" => 'text/csv',
            'Content-Disposition' => 'attachment; filename=participants.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check-0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['Last Name', 'First Name','Designation', 'School', 'Email'];

        $callback = function() use ($columns, $conv) {
            $file = fopen('php://output','w');

            fputcsv($file, $columns);

            foreach($conv->participants as $p) {
                fputcsv($file, [
                    $p->user->lname,
                    $p->user->fname,
                    $p->user->designation,
                    $p->user->school,
                    $p->user->email,
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'PSITE-7 convention participants-' . date('d-m-Y-H:i:s') . '.csv', $headers);
    }
}
