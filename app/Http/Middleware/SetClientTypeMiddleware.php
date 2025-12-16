<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use App\Models\ErrorLog;
use Illuminate\Http\Response;

class SetClientTypeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // return ApiResponse::respond($request->header('x-Requested-With'), true, '.!', Response::HTTP_NOT_ACCEPTABLE);
        if ($request->headers->has('x-Requested-With')) {
            $clientType = 'app';
        } elseif ($request->headers->has('x-Requested-With')) {
            $clientType = 'web';
        } else {
            $this->logUnrecognizedClientType($request);
            return ApiResponse::respond('', false, 'Access denied.!', Response::HTTP_NOT_ACCEPTABLE);
        }
        
        $request->attributes->set('clientType', $clientType);

        return $next($request);
    }

    protected function logUnrecognizedClientType(Request $request): void
    {
        $errorData = [
            'message' => 'Unrecognized client type',
            'url' => $request->url(),
            'method' => $request->method(),
            'user_id' => auth()->id() ?? null,
            'ip_address' => $request->ip(),
            'timestamp' => now(),
            'session_id' => session()->getId(),
            'previous_url' => url()->previous(),
            'query_string' => $request->getQueryString(),
            'headers' => json_encode($request->headers->all()),
            'payload' => json_encode($request->all()),
            'client_type' => 'unknown',
        ];

        ErrorLog::create($errorData);
    }
}
