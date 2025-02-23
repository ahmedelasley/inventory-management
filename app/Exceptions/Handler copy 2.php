<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Database\ConnectionException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use RuntimeException;
use ErrorException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        // 🔹 تحديد رسالة الخطأ
        $message = config('app.debug') 
            ? $exception->getMessage() 
            : 'An unexpected error occurred. Please try again later.';

        // 🔹 إخفاء مسارات الملفات من رسالة الخطأ عند تعطيل debug
        if (!config('app.debug')) {
            $message = preg_replace('/\/.*\/(App|vendor|storage|public)\/.*\.php/', '[hidden_path]', $message);
        }

        // 🔹 قائمة الأخطاء المحتملة
        $errors = [
            ModelNotFoundException::class => ['Record not found!', Response::HTTP_NOT_FOUND, 'errors.404'],
            AuthenticationException::class => ['Authentication required!', Response::HTTP_UNAUTHORIZED, 'errors.401'],
            HttpException::class => [$exception->getMessage(), $exception->getStatusCode(), "errors.{$statusCode}"],
            ValidationException::class => ['Invalid input data!', Response::HTTP_UNPROCESSABLE_ENTITY, 'errors.422'],
            QueryException::class => ['Database query error!', Response::HTTP_INTERNAL_SERVER_ERROR, 'errors.500'],
            UniqueConstraintViolationException::class => ['This data already exists!', Response::HTTP_CONFLICT, 'errors.500'],
            RouteNotFoundException::class => ['Route not found!', Response::HTTP_NOT_FOUND, 'errors.404'],
            TokenMismatchException::class => ['Session expired, please try again!', Response::HTTP_FORBIDDEN, 'errors.419'],
            ThrottleRequestsException::class => ['Too many requests, please try again later!', Response::HTTP_TOO_MANY_REQUESTS, 'errors.429'],
            ConnectionException::class => ['Database connection failed!', Response::HTTP_INTERNAL_SERVER_ERROR, 'errors.500'],
            FileNotFoundException::class => ['File not found!', Response::HTTP_NOT_FOUND, 'errors.404'],
            RuntimeException::class => ['A runtime error occurred!', Response::HTTP_INTERNAL_SERVER_ERROR, 'errors.500'],
            ErrorException::class => ['A fatal error occurred!', Response::HTTP_INTERNAL_SERVER_ERROR, 'errors.500'],
        ];

        // 🔹 تحديد رسالة الخطأ ورمز الحالة وملف العرض المناسب
        if (array_key_exists(get_class($exception), $errors)) {
            [$message, $statusCode, $errorView] = $errors[get_class($exception)];
        } else {
            $errorView = "errors.any";
        }

        // ✅ **تسجيل الخطأ في Log**
        Log::error("Error: {$message}", [
            'exception' => get_class($exception),
            'status_code' => $statusCode,
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
        ]);

        // ✅ **إرجاع صفحة الخطأ**
        return response()->view($errorView, [
            'code' => $statusCode,
            'error_type' => get_class($exception),
            'message' => $message
        ], $statusCode);
    }
}
