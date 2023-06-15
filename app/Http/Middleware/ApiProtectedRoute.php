<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiProtectedRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                $returnMessage = response()->json(['status' => 'Token is Invalid']);
            } elseif ($e instanceof TokenExpiredException) {
                $returnMessage = response()->json(['status' => 'Token is Expired']);
            } else {
                $returnMessage = response()->json(['status' => 'Authorization Token is not found']);
            }
            return $returnMessage;
        }

        return $next($request);
    }
}
