<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Models\ErrorLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return parent::render($request, $exception);
        }
        $statusCode = $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
            ? $exception->getStatusCode()
            : JsonResponse::HTTP_INTERNAL_SERVER_ERROR;

        $this->logError($request, $exception, $statusCode);

        if ($request->wantsJson()) {
            return response()->json([
                'error' => $exception->getMessage(),
                'status' => $statusCode,
            ], $statusCode);
        }
        // dd($exception);
        return $this->renderErrorPage($statusCode);
    }

    protected function logError(Request $request, Throwable $exception, int $statusCode): void
    {
        $errorData = [
            'message' => $exception->getMessage(),
            'url' => $request->url(),
            'method' => $request->method(),
            'client_type' => $request->get('clientType', 'unknown'),
            'user_id' => auth()->id(),
            'ip_address' => $request->ip(),
            'timestamp' => now(),
            'session_id' => session()->getId(),
            'previous_url' => url()->previous(),
            'query_string' => $request->getQueryString(),
            'headers' => json_encode($request->headers->all()),
            'payload' => json_encode($request->except($this->dontFlash)),
            'stack_trace' => $exception->getTraceAsString(),
            'status_code' => $statusCode,
        ];

        try {
            ErrorLog::create($errorData);
        } catch (\Exception $e) {
            // Handle logging failure (e.g., send to a different log, notify admin)
        }
    }

    protected function renderErrorPage(int $statusCode): Response
    {
        $view = $this->getErrorView($statusCode);
        return response()->view($view, ['status' => $statusCode], $statusCode);
    }

    protected function getErrorView(int $statusCode): string
    {
        switch ($statusCode) {
            case 404:
                return 'errors.404';
            case 500:
                return 'errors.500';
            // Add other cases for different status codes as needed
            default:
                return 'errors.default';
        }
    }
}
