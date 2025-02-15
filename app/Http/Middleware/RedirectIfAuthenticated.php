<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {


            if (Auth::guard($guard)->check() && $guard == "admin") {
                return redirect(RouteServiceProvider::Admin);
            }
            if (Auth::guard($guard)->check() && $guard == "manager") {
                return redirect(RouteServiceProvider::Manager);
            }
            if (Auth::guard($guard)->check() && $guard == "supervisor") {
                return redirect(RouteServiceProvider::Supervisor);
            }
            if (Auth::guard($guard)->check() && $guard == "keeper") {
                return redirect(RouteServiceProvider::Keeper);
            }

            //General
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
