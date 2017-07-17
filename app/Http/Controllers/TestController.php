<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Question;
use App\Status;
use App\User;
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

    public function indexProf() {

        $tests = Test::where('user_id', Auth::id())->get();

        return view('admin.tests.indexProf')->with([
            'tests' => $tests,
        ]);
    }

    public function create() {

        $statuses = Status::all();
        $categories = Category::all();
        $user = Auth::id();

        return view('admin.tests.create')->with([

            'statuses' => $statuses,
            'categories' => $categories,
            'user' => $user,
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
        $test->access_key = $request->access_key;
        $test->user_id = Auth::id();
        $test->save();
        if($test->save()){
            if(isset($request->questionName)){
                foreach($request->questionName as $key => $question){
                    $newQuestion = new Question();
                    $newQuestion->body = $question['body'];
                    $newQuestion->test_id = $test->id;
                    if($newQuestion->save()){
                        if(isset($question['answers']) && is_array($question['answers'])){
                            foreach($question['answers'] as $ansKey => $answer){
                                $newAnswer = new Answer();
                                $newAnswer->body = $answer['body'];
                                $newAnswer->question_id = $newQuestion->id;
                                $newAnswer->correct = isset($answer['correct']) ? true: false;
                                $newAnswer->save();
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('testsIndexProf');
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
        $test->access_key = $request->access_key;
        if($test->save()){
            if(isset($request->questionName)){
                foreach($request->questionName as $key => $question){
                    $newQuestion = new Question();
                    $newQuestion->body = $question['body'];
                    $newQuestion->test_id = $test->id;
                    if($newQuestion->save()){
                        if(isset($question['answers']) && is_array($question['answers'])){
                            foreach($question['answers'] as $ansKey => $answer){
                                $newAnswer = new Answer();
                                $newAnswer->body = $answer['body'];
                                $newAnswer->question_id = $newQuestion->id;
                                $newAnswer->correct = isset($answer['correct']) ? true: false;
                                $newAnswer->save();
                            }
                        }
                    }
                }
            }
        }


        return redirect()->route('testsIndexProf');
    }

    public function delete(Test $test) {

        $test->delete();

        return back();
    }

    public function access(Test $test){
        return view('admin.tests.access')->with('test', $test);
    }

    public function checkKey(Request $request,Test $test){
        if($test->access_key == $request->access_key){
            return view('admin.tests.take')->with('test', $test);
        }else{
            return back();
        }
    }

    public function takeTest(Request $request, Test $test){

        $user = Auth::user();

        $maxGrade = 10;
        $minGrade = 0;
        $userGrade = 0;

        $gradePerQuestion = $maxGrade / $test->questions()->count();

        foreach($test->questions as $key => $question){
            $countQuestionAnswers = $question->answers()->correct(true)->count();
            $gradePerAnswer = $gradePerQuestion / $countQuestionAnswers;

            if(isset($request->answer[$question->id]) && $countQuestionAnswers >= count($request->answer[$question->id])){
                foreach($question->answers()->correct(true)->get() as $q => $qAns){
                    if(in_array($qAns->id, $request->answer[$question->id])){
                        $userGrade += $gradePerAnswer;
                    }
                }
            }
        }

        $user->tests()->save($test,['grade' => $userGrade, 'answered' => json_encode($request->answer)]);

        return redirect()->route('taken', $test->id);

    }

    public function takenTest(Test $test){
        return view('admin.tests.taken')->with('test', $test);
    }

    public function gradeList(Test $test){
        $students = $test->students;

        return view('admin.tests.grades')->with([
            'students' => $students,
            'test' => $test
        ]);
    }
}
