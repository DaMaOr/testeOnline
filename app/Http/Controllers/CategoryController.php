<?php

namespace App\Http\Controllers;

use App\Category;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::where('user_id', Auth::id())->get();

        return view('admin.categories.index')->with([
            'categories' => $categories,
        ]);
    }

    public function indexStud() {

        $categories = Category::all();
        $users = User::all();

        return view('admin.categories.indexStud')->with([
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    public function create() {

        $statuses = Status::all();

        return view('admin.categories.create')->with([

            'statuses' => $statuses,
        ]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:categories',
            'statusCategory' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->status_id = $request->statusCategory;
        $category->user_id = $request->user()->id;
        $category->save();

        return redirect()->route('categoriesIndex');
    }

    public function edit(Category $category) {

        $statuses = Status::all();

        return view('admin.categories.edit')->with([

            'statuses' => $statuses,
            'category' => $category,
        ]);
    }


    public function update(Category $category, Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'statusCategory' => 'required',
        ]);
        $category->name = $request->name;
        $category->status_id = $request->statusCategory;
        $category->save();

        return redirect()->route('categoriesIndex');
    }

    public function delete(Category $category) {

        $category->delete();

        return back();
    }
}
