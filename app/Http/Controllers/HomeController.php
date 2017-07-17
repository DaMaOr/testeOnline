<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function usersList(){
        $users = User::where('roles', '<>', User::ADMIN)->get();

        return view('admin.users.list')->with([
            'users' => $users
        ]);
    }

    public function usersChangeStat(User $user, $status){
        if($user->verified !== $status){
            $user->verified = $status;
            $user->save();
        }

        return back();
    }
}
