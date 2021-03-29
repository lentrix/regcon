<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convention;

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


}
