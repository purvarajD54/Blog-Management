<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function login()
{
    return view('user.login'); 
}


    public function register()
    {
        return view('user.register');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8|max:12|confirmed'
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect()->route('user.register')->with('success', 'You are registered');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12'
        ]);

        $userinfo = User::where('email', $request->email)->first();

        if (!$userinfo) {
            return back()->with('Fail', 'We Don’t Recognize You');
        }

        if (Hash::check($request->password, $userinfo->password)) {
            $request->session()->put('LoggedUser', $userinfo->id);
            return redirect('/user/dashboard');
        } else {
            return back()->with('Fail', 'Incorrect password');
        }
    }
    public function dashboard(){
        $LoggedUser=User::with('posts')->find(session('LoggedUser'));
        if(!$LoggedUser){
            return redirect('user/login')->with('Fail', 'you must be logged in ');
        }
         return view('user.dashboard',['LoggedUser'=>$LoggedUser]);

    }

    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('user/login');
        }
    }
}
