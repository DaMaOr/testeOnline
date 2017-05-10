<?php

namespace App\Http\Controllers;

use App\Category;
use App\Status;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::all();

        return view('admin.categories.index')->with([
            'categories' => $categories,
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
