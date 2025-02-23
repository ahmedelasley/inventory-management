<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;


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


    // public function render($request, Throwable $exception)
    // {
    //     // $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

    //     // $message = preg_replace('/\/.*\/(App|vendor|storage|public)\/.*\.php/', '[hidden_path]', $exception->getMessage());
    //     // $message = config('app.debug') ? $exception->getMessage() : 'An unexpected error occurred. Please try again later.';

    //     // if ($exception instanceof ModelNotFoundException) {
    //     //     // $message = config('app.debug') ? $exception->getMessage() : 'Record not found!';
    //     //     return response()->view('errors.404', ['code' => 404, 'error_type' => get_class($exception), 'message' => "" ], Response::HTTP_NOT_FOUND);
    //     // }

    //     if ($exception instanceof HttpException) {
    //         $message = config('app.debug') ? $exception->getMessage() : $exception->getMessage();
    //         return response()->view("errors.{$statusCode}", ['code' => $statusCode, 'message' => $exception->getMessage()], $statusCode);
    //     }
    //     // return response()->view("errors.any", ['code' => 500, 'error_type' => get_class($exception), 'message' => "" ], $statusCode);
    
    // }





}
