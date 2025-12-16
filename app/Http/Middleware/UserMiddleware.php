<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current route name
        $routeName = Route::currentRouteName();

        // Bypass middleware for login and registration routes
        if (in_array($routeName, ['login', 'register'])) { // Replace 'login' and 'register' with your actual route names
            return $next($request);
        }

        $user = $request->user();

        if (!$user) {
            return ApiResponse::respond(null, false, 'Unauthorized.', Response::HTTP_UNAUTHORIZED);
        }

        if ($user->type !== 'user') {
            return ApiResponse::respond(null, false, 'You are not authorized to access this resource. (Invalid user type)', Response::HTTP_FORBIDDEN);
        }

        if (!$user->status) {
            return ApiResponse::respond(null, false, 'Your account is inactive. Please contact support.', Response::HTTP_FORBIDDEN);
        }

        $visitData = [
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'session_id' => $request->session()->getId(),
            'previous_url' => $request->headers->get('referer'),
            'query_string' => $request->getQueryString(),
            'headers' => json_encode($request->headers->all()),
            'payload' => json_encode($request->all()),
        ];

        try {
            Visit::create($visitData);
        } catch (\Exception $e) {
            Log::error("Error creating visit log: " . $e->getMessage());
        }

        return $next($request);
    }
}
