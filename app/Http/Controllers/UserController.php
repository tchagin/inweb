<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginForm(){
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'You are logged');
            if (Auth::user()) {
                return redirect()->route('admin.index');
            }
        }

        return redirect()->back()->with('error', 'Incorrect login or password');
    }
}
