<?php

namespace App\Http\Middleware;

use App\Enum\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role != RoleEnum::Admin->value) {
            return $next($request);
        }

         return response()->json(['message' => 'Acesso não autorizado'], 403);
    }
}
