<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login atau role tidak sesuai, lempar ke 403
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses Terlarang.');
        }

        return $next($request);
    }
}