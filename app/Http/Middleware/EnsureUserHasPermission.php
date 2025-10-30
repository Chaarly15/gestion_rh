<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!$request->user()) {
            abort(401, 'Non authentifié.');
        }

        // Vérifier si l'utilisateur a la permission requise
        if (!$request->user()->hasPermissionTo($permission)) {
            abort(403, "Accès refusé. Vous n'avez pas la permission: {$permission}");
        }

        return $next($request);
    }
}

