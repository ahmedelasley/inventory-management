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
        $message =  'An unexpected error occurred. Please try again later.';

        if ($exception instanceof ModelNotFoundException) {
            $message = 'Record not found!';
            return response()->view('errors.404', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_NOT_FOUND);
        }
    
        if ($exception instanceof AuthenticationException) {
            $message = 'Authentication required!';
            return response()->view('errors.401', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_UNAUTHORIZED);
        }
    
        if ($exception instanceof HttpException) {
            $message = $exception->getMessage();
            return response()->view("errors.{$statusCode}", ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], $statusCode);
        }
    
        if ($exception instanceof ValidationException) {
            $message = 'Invalid input data!';
            return response()->view('errors.422', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        if ($exception instanceof QueryException) {
            $message = 'Database query error!';
            return response()->view('errors.500', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        if ($exception instanceof UniqueConstraintViolationException) {
            $message = 'This data already exists!';
            return response()->view('errors.500', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_CONFLICT);
        }
    
        if ($exception instanceof RouteNotFoundException) {
            $message = 'Route not found!';
            return response()->view('errors.404', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_NOT_FOUND);
        }
    
        if ($exception instanceof TokenMismatchException) {
            $message = 'Session expired, please try again!';
            return response()->view('errors.419', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_FORBIDDEN);
        }
    
        if ($exception instanceof ThrottleRequestsException) {
            $message = 'Too many requests, please try again later!';
            return response()->view('errors.429', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_TOO_MANY_REQUESTS);
        }
    
        if ($exception instanceof ConnectionException) {
            $message = 'Database connection failed!';
            return response()->view('errors.500', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        if ($exception instanceof FileNotFoundException) {
            $message = 'File not found!';
            return response()->view('errors.404', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_NOT_FOUND);
        }
    
        if ($exception instanceof RuntimeException) {
            $message = 'A runtime error occurred!';
            return response()->view('errors.500', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // if ($exception instanceof ErrorException) {
        //     $message = 'A fatal error occurred!';
        //     return response()->view('errors.500', ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        return response()->view("errors.any", ['code' => $statusCode, 'error_type' => get_class($exception), 'message' => $message ], $statusCode);
    
    }
}
