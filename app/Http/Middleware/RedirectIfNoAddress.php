<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNoAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $userId = Auth::id();

            $user = User::where('id', $userId)->first();

            if ($user->addresses->isEmpty()) return redirect()->route('page.address.create', $user->username);
        }
        return $next($request);
    }
}
