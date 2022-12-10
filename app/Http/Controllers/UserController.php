<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    //Show register Create Form
    function register(){
        return view('listings.register');
    }


    // create new Users
    function store(Request $request){
//        return 'hello register';
        $FiledRequest=$request->validate([
           'name' => ['required','min:3'],
           'email' => ['required','email',Rule::unique('users','email')],
           'password' => 'required|confirmed|min:6'
                /*['required','confirmed','min:6']*/   ,
        ]);

        // Hash Password
        $FiledRequest['password'] = bcrypt($FiledRequest['password']);

        // Create User
        $users = User::create($FiledRequest);

        // Login
        auth()->login($users);
        return redirect('/')->with('message','created Users SuccessFully and Login ');
    }


    // login user this website
    function login(){
        return view('listings.login');
    }


    function authenticate(Request $request){
        $FieldsForm = $request->validate([
           'email' => ['required','email'],
           'password' => 'required',
        ]);
        if (auth()->attempt($FieldsForm)){
            $request->session()->regenerate();
            return redirect('/')->with('message','Login SuccessFully in the website');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}
