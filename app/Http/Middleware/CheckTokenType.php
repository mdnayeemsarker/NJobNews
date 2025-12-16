<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return ApiResponse::respond(null, false, 'Token not provided.!',JsonResponse::HTTP_UNAUTHORIZED);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return ApiResponse::respond(null, false, 'Invalid token.!', JsonResponse::HTTP_UNAUTHORIZED);
        }

        $abilities = $accessToken->abilities;

        if (in_array('registration', $abilities)) {
            $request->attributes->set('token_type', 'registration');
        } elseif (in_array('login', $abilities)) {
            $request->attributes->set('token_type', 'login');
        } else {
            return ApiResponse::respond(null, false, 'Unauthorized access.!', JsonResponse::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
