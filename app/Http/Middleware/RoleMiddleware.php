<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        //cek ricek login atau blm
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        //cek role
        if ($user->role !== $role) {
            return redirect('/login');
        }

        return $next($request);
    }
}
