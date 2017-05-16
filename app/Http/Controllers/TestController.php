<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    public function index() {

        $tests = Test::all();

        return view('admin.tests.index')->with([
            'tests' => $tests,
        ]);
    }

    public function create() {

        $tests = Test::all();

        return view('admin.tests.create')->with([

            'tests' => $tests,
        ]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:tests',
        ]);

        $test = new Test();
        $test->name = $request->name;
        $test->save();

        return redirect()->route('testsIndex');
    }

    public function edit(Test $test) {

        return view('admin.tests.edit');
    }


    public function update(Test $test, Request $request) {

        $this->validate($request, [
            'name' => 'required',
        ]);
        $test->name = $request->name;
        $test->save();

        return redirect()->route('testsIndex');
    }

    public function delete(Test $test) {

        $test->delete();

        return back();
    }
}
