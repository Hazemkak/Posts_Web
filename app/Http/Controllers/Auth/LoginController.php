<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.login');
    }

    public function enter(Request $req){
        $this->validate($req,[
            'email'=>'required|email|max:255',
            'password'=>'required',
        ]);

        if(Auth::attempt($req->only('email','password'),$req->only('remember'))){
            return redirect()->route('dashboard');
        }

        return back()->with('status','Invalid login details');

    }
}
