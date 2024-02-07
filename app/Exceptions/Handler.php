<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return $this->apiError('Not Found', 404);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e) {
            return $this->apiError('Not Allowed Http Method', 405);
        });

        $this->renderable(function (ApiException $e) {
            return $this->apiError($e->getMessage(), $e->getCode());
        });

        $this->reportable(function (Throwable $e) {
            return $this->apiError('Internal Server Error', 500);
        });
    }

    protected function apiError($message, $code): JsonResponse
    {
        return response()->json(['message' => $message], $code);
    }
}
