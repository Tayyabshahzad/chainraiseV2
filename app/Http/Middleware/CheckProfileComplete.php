<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckProfileComplete
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
        // Check if the user is logged in
    if (Auth::check()) {
        // Check if the user's profile is complete
        $user = Auth::user();
        if ($user->profile_status !=1) {
            // Redirect the user to the setup page
            return redirect()->route('user.setup');
        }
    }

    // Allow the request to continue to the next middleware or the controller
    return $next($request);
    }
}
