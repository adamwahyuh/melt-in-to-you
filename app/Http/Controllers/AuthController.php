<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request){
        $data = $request->validated();

        if (Auth::attempt($data)){
            $request->session()->regenerate();
            $user = Auth::id();
            $user = User::where('id', $user)->first();

            if($user->peran()->exists()) return redirect()->route('page.dashboard.index');
            
            return redirect()->route('index');
        }

        return back();
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        return redirect()->route('page.login');
    }

    public function resgister(RegisterRequest $request){
        $data = $request->validated();
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'=> Hash::make($data['password']),
            'username' => $data['username'],
        ]);

        return redirect()->route('page.login')->with('success', 'Berhasil Register Akun 💅');
    }
}
