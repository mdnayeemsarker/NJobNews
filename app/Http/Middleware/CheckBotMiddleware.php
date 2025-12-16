<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckBotMiddleware
{
    protected $botKeywords = [
        'bot', 'crawl', 'slurp', 'spider', 'mediapartners', 'googlebot', 
        'bingbot', 'yandexbot', 'duckduckbot', 'baiduspider', 'sogou', 'exabot',
        'facebot', 'ia_archiver', 'applebot'
    ];

    public function handle(Request $request, Closure $next)
    {
        $userAgent = $request->header('User-Agent');

        if ($this->isBot($userAgent)) {
            return ApiResponse::respond('', false, 'Access denied.', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    protected function isBot($userAgent)
    {
        if (!$userAgent) {
            return false;
        }

        foreach ($this->botKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }
}
