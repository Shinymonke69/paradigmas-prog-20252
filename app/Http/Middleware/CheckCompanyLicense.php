<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCompanyLicense
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        
        if (!$user || !$user->company) {
            return response()->json(['message' => 'Usuário não vinculado a uma empresa.'], 403);
        }

        
        if (!$user->company->license_active) {
            return response()->json(['message' => 'Licença da empresa expirada.'], 403);
        }

        return $next($request);
    }
}
