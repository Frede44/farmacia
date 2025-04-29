<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view("Auth.Register");
    }

    public function store(Request $request)
    {
        $user =User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
           


        auth()->login($user);

        // Logic to create a new user

        return redirect()->route('dashboard.index')->with('success', 'Registration successful!');
    }
}
