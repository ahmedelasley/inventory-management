<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        // $message = preg_replace('/\/.*\/(App|vendor|storage|public)\/.*\.php/', '[hidden_path]', $exception->getMessage());
        $message = config('app.debug') ? $exception->getMessage() : 'An unexpected error occurred. Please try again later.';

        if ($exception instanceof ModelNotFoundException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Record not found!';
            return response()->view('errors.404', [], Response::HTTP_NOT_FOUND);
        }
    
        if ($exception instanceof AuthenticationException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Authentication required!';
            return response()->view('errors.401', [], Response::HTTP_UNAUTHORIZED);
        }
    
        if ($exception instanceof HttpException) {
            $message = config('app.debug') ? $exception->getMessage() : $exception->getMessage();
            return response()->view("errors.{$statusCode}", ['code' => $statusCode, 'message' => $exception->getMessage()], $statusCode);
        }
    
        if ($exception instanceof ValidationException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Invalid input data!';
            return response()->view('errors.422', [], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        if ($exception instanceof QueryException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Database query error!';
            return response()->view('errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        if ($exception instanceof UniqueConstraintViolationException) {
            $message = config('app.debug') ? $exception->getMessage() : 'This data already exists!';
            return response()->view('errors.500', [], Response::HTTP_CONFLICT);
        }
    
        if ($exception instanceof RouteNotFoundException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Route not found!';
            return response()->view('errors.404', ['code' => $statusCode, 'message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
        }
    
        if ($exception instanceof TokenMismatchException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Session expired, please try again!';
            return response()->view('errors.419', [], Response::HTTP_FORBIDDEN);
        }
    
        if ($exception instanceof ThrottleRequestsException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Too many requests, please try again later!';
            return response()->view('errors.429', [], Response::HTTP_TOO_MANY_REQUESTS);
        }
    
        if ($exception instanceof ConnectionException) {
            $message = config('app.debug') ? $exception->getMessage() : 'Database connection failed!';
            return response()->view('errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        if ($exception instanceof FileNotFoundException) {
            $message = config('app.debug') ? $exception->getMessage() : 'File not found!';
            return response()->view('errors.404', [], Response::HTTP_NOT_FOUND);
        }
    
        if ($exception instanceof RuntimeException) {
            $message = config('app.debug') ? $exception->getMessage() : 'A runtime error occurred!';
            return response()->view('errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof ErrorException) {
            $message = config('app.debug') ? $exception->getMessage() : 'A fatal error occurred!';
            return response()->view('errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->view("errors.any", ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], $statusCode);
    
    }
}
