<?php

namespace App\Http\Controllers;

use App\Category;
use App\Status;
use Illuminate\Http\Request;
use App\Test;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index() {

        $tests = Test::all();

        return view('admin.tests.index')->with([
            'tests' => $tests,
        ]);
    }

    public function create() {

        $statuses = Status::all();
        $categories = Category::all();

        return view('admin.tests.create')->with([

            'statuses' => $statuses,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:tests',
        ]);

        $test = new Test();
        $test->name = $request->name;
        $test->status_id = $request->status;
        $test->category_id = $request->category;
        $test->user_id = Auth::id();
        $test->save();

        return redirect()->route('testsIndex');
    }

    public function edit(Test $test) {

        $statuses = Status::all();
        $categories = Category::all();

        return view('admin.tests.edit')->with([

            'statuses' => $statuses,
            'categories' => $categories,
            'test' => $test,
        ]);

    }


    public function update(Test $test, Request $request) {

        $this->validate($request, [
            'name' => 'required',
        ]);
        $test->name = $request->name;
        $test->status_id = $request->status;
        $test->category_id = $request->category;
        $test->save();

        return redirect()->route('testsIndex');
    }

    public function delete(Test $test) {

        $test->delete();

        return back();
    }
}
