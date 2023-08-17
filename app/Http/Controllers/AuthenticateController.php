<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    function createSignIn(){
        return view('auth.signin');
    }

    function createSignUp(){
        return view('auth.signup');
    }

    function storeSignUp(Request $request){
        $validations = $request->validate([
            'nama'=>'required',
            'password'=>'required'
        ]);

        $validations['nomor-kasir'] = Str::random(16);
        $validations['password'] = bcrypt($request->password);

        User::create($validations);

        return redirect('/sign-in');
    }

    function  storeSignIn(Request $request)
    {
        $credentials = $request->validate([
            'nomor-kasir' => ['required', 'min:16'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back();
    }

     function logout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }}
