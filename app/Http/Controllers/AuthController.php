<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request){
        $data = $request->validated();

        if (Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        return back();
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        return redirect()->route('page.login');
    }
}
