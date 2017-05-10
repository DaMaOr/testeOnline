<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index() {

        $statuses = Status::all();

        return view('admin.statuses.index')->with([
            'statuses' => $statuses,
        ]);
    }

    public function create() {

        return view('admin.statuses.create');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:statuses',
        ]);

        $status = new Status();
        $status->name = $request->name;
        $status->save();

        return redirect()->route('statusesIndex');
    }
}
