<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
{
    // Jika user belum login atau role-nya tidak sesuai, lempar ke dashboard awal
    if (!$request->user() || $request->user()->role !== $role) {
        return redirect('/dashboard')->with('error', 'Anda tidak punya akses ke halaman tersebut.');
    }

    return $next($request);
}
}
