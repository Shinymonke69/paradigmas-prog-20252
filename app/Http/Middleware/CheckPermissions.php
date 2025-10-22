<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $user = Auth::user();

        
        if (!$user || !$user->hasPermission($permissions)) {
            return response()->json(['message' => 'Permissão insuficiente.'], 403);
        }

        return $next($request);
    }
}
