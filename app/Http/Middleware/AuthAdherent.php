<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdherent
{
    /**
     * @param string $minRole Rôle minimum requis (0=adhérent, 1=entraîneur, 2=admin)
     */
    public function handle(Request $request, Closure $next, string $minRole = '0'): Response
    {
        if (!session()->has('adherent')) {
            return redirect('/connexion')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        if ((int) session('adherent')->ADH_ROLE < (int) $minRole) {
            abort(403, 'Vous n\'avez pas les droits pour accéder à cette page.');
        }

        return $next($request);
    }
}
