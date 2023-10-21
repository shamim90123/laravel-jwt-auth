<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Crypt;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $userDetail = unserialize(Crypt::decryptString(app('request')->header('user_detail')));
        // return $userDetail['user_id'];

        Log::info($userDetail['user_id']);

        if (Auth::check()) {
            return $next($request);
        }

        return false;

        // return redirect('/login'); // Redirect to login if not authenticated
    }
}
