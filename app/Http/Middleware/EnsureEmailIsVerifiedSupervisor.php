<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerifiedSupervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('supervisor')->user();

        if ($user && is_null($user->email_verified_at)) {
            Auth::guard('supervisor')->logout(); // تسجيل الخروج
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('supervisor.login')->with('error', 'Your email is not verified.');
        }

        return $next($request);
    }
}
