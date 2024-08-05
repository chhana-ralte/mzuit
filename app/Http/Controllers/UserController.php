<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function login(){
        return view('user.login');
    }

    public function logincheck(){
        $login = Auth::attempt([
            'username' => request()->username,
            'password' => request()->password
        ]);
        if($login){
            request()->session()->regenerate();
            //if(auth()->user()->level < 5)
            //    Log::create(['user_id' => auth()->user()->id]);
            return redirect('/');
        }
        else{
            return view('user.login',['message' => 'Login failed']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
