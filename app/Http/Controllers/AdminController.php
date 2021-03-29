<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convention;
use App\User;

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


}
