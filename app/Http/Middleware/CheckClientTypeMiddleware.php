<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckClientTypeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $clientType = $request->header('x-Requested-With');
        $request->attributes->set('clientType', $clientType);
        
        if (!$clientType || !in_array($clientType, ['app', 'web'])) {
            return ApiResponse::respond('', false, 'Missing Required Parameter.!', 400);
        }
        if ($request->hasHeader('x-api-key')) {
            if (!$this->isValid($request->header('x-api-key'))) {
                return ApiResponse::respond('', false, 'Key not match.!', Response::HTTP_CONFLICT);
            }
            return $next($request);
        }
        else {
            return ApiResponse::respond('', false, 'Directly access not allowed.!', Response::HTTP_BAD_GATEWAY);
        }
    }
    private function isValid($data) {
        if ($data === 'AbmN!@0171#4466$703') {
            return true;
        }else{
            return false;
        }
    }
}
