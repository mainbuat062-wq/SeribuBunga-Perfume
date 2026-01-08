<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Check if user is admin or superadmin
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized access. Admin only.');
        }

        return $next($request);
    }
}