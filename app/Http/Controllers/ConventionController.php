<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Convention;

class ConventionController extends Controller
{
    public function create() {
        return view('admin.convention.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'host_school' => 'required',
            'chairman' => 'required',
            'schedule' => 'required',
            'theme' => 'required',
        ]);

        Convention::create($request->all());

        return redirect('/admin')->with('Info', 'A new convention was created.');
    }

    public function activate(Convention $convention) {
        DB::update("update conventions set convention_status='inactive' where convention_status='active'");
        $convention->convention_status = 'active';
        $convention->save();

        return redirect('/admin')->with('Info',"Convention $convention->title has been activated.");
    }
}
