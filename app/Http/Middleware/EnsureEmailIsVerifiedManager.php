<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerifiedManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('manager')->user();

        if ($user && is_null($user->email_verified_at)) {
            Auth::guard('manager')->logout(); // تسجيل الخروج
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('manager.login')->with('error', 'Your email is not verified.');
        }

        return $next($request);
    }
}
