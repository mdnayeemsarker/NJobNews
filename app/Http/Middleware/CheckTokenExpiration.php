<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->isTokenExpired($request)) {
            return ApiResponse::respond(null, false, 'Token has expired. Please reauthenticate.!', JsonResponse::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }

    protected function isTokenExpired($request)
    {
        $user = $request->user();
        $token = $user->currentAccessToken();
        return $token && $token->expires_at && now()->isAfter($token->expires_at);
    }
}
