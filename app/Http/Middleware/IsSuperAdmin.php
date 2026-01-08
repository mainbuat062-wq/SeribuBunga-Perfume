<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSuperAdmin
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
    // Jika belum login → tendang ke login admin
    if (!Auth::check()) {
        return redirect()->route('admin.login')
            ->with('error', 'Silakan login terlebih dahulu.');
    }

    // Jika bukan superadmin → arahkan ke halaman forbidden
    if (Auth::user()->role !== 'superadmin') {
        return response()->view('admin.admin_user.forbidden', [], 403);
    }

    return $next($request);
}

}