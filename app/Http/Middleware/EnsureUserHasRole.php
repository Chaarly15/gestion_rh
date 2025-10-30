<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            abort(401, 'Non authentifié.');
        }

        // Vérifier si l'utilisateur a le rôle requis
        if (!$request->user()->hasRole($role)) {
            abort(403, "Accès refusé. Vous devez avoir le rôle: {$role}");
        }

        return $next($request);
    }
}

