<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! in_array($user->role->value, $roles, true)) {
            return redirect($user->homeUrl())
                ->with('error', 'Cette section est réservée aux organisateurs d\'événements.');
        }

        return $next($request);
    }
}
