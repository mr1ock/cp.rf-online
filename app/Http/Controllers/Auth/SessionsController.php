<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{


    public function username() {
        return 'name';
    }


    public function __construct() {
        $this->middleware('guest', ['except' => 'destroy']);
    }





    public function create() {
      
        return view('sessions.create');
    }  

    public function store() {
      
        if(! auth()->attempt(request(['name', 'password']))) {
           return back()->withErrors([

            'message' => 'Логин или Пароль не верный'

           ]); 
        }

        return redirect()->home();

    } 

    public function destroy() {

        Auth::logout();

        return redirect()->route('login');
    }
    
}
