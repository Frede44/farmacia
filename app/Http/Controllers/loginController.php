<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function index()
    {
        return view("Auth.login");
    }

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/dashboard');
        }else{
            return redirect()->back()->with('error', 'Invalid credentials!');
        }

      
    }

    public function destroy(Request $request)
    {
        auth()->logout();

        return redirect()->route('login.index')->with('success', 'sesion cerrada con exito!');
    }
}

