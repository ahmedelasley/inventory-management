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
        // 🔹 1. خطأ في البحث عن سجل غير موجود في قاعدة البيانات
        if ($exception instanceof ModelNotFoundException) {  
            return response()->view("errors.any", [
                'code' => 404,
                'error_type' => class_basename($exception),
                'message' => 'Record not found!'
            ], 404);
        }
    
        // 🔹 2. خطأ في المصادقة (يجب تسجيل الدخول)
        if ($exception instanceof AuthenticationException) {
            return response()->view("errors.any", [
                'code' => 401,
                'error_type' => class_basename($exception),
                'message' => 'Authentication required!'
            ], 401);
        }
    
        // 🔹 3. خطأ في الصلاحيات (ليس لديك إذن للوصول)
        if ($exception instanceof HttpException) {
            return response()->view("errors.any", [
                'code' => 404,
                'error_type' => class_basename($exception),
                'message' => '!'
            ], 404);
        }
    
        // 🔹 4. خطأ في التحقق من المدخلات
        if ($exception instanceof ValidationException) {
            return response()->view("errors.any", [
                'code' => 422,
                'error_type' => class_basename($exception),
                'message' => 'Invalid input data!'
            ], 422);
        }
    
        // 🔹 5. خطأ في قاعدة البيانات (استعلام غير صحيح)
        if ($exception instanceof QueryException) {
            return response()->view("errors.any", [
                'code' => 500,
                'error_type' => class_basename($exception),
                'message' => 'Database query error!'
            ], 500);
        }
    
        // 🔹 6. خطأ في قاعدة البيانات (تكرار قيود فريدة)
        if ($exception instanceof UniqueConstraintViolationException) {
            return response()->view("errors.any", [
                'code' => 404,
                'error_type' => class_basename($exception),
                'message' => '!'
            ], 404);
        }
    
        // 🔹 7. خطأ عند محاولة الوصول إلى Route غير موجود
        if ($exception instanceof RouteNotFoundException) {
            return response()->view("errors.any", [
                'code' => 404,
                'error_type' => class_basename($exception),
                'message' => 'Route not found!'
            ], 404);
        }
    
        // 🔹 8. خطأ في صلاحية الجلسة (CSRF)
        if ($exception instanceof TokenMismatchException) {
            return response()->view("errors.any", [
                'code' => 419,
                'error_type' => class_basename($exception),
                'message' => 'Session expired, please try again!'
            ], 419);
        }
    
        // 🔹 9. خطأ في تجاوز الحد المسموح من الطلبات (Throttle)
        if ($exception instanceof ThrottleRequestsException) {
            return response()->view("errors.any", [
                'code' => 429,
                'error_type' => class_basename($exception),
                'message' => 'Too many requests, please try again later!'
            ], 429);
        }
    
        // 🔹 10. خطأ في الاتصال بقاعدة البيانات
        if ($exception instanceof ConnectionException) {
            return response()->view("errors.any", [
                'code' => 500,
                'error_type' => class_basename($exception),
                'message' => 'Database connection failed!'
            ], 500);
        }
    
        // 🔹 11. خطأ عند عدم العثور على ملف
        if ($exception instanceof FileNotFoundException) {
            return response()->view("errors.any", [
                'code' => 404,
                'error_type' => class_basename($exception),
                'message' => 'File not found!'
            ], 404);
        }
    
        // 🔹 12. خطأ في وقت التشغيل
        if ($exception instanceof RuntimeException) {
            return response()->view("errors.any", [
                'code' => 500,
                'error_type' => class_basename($exception),
                'message' => 'A runtime error occurred!'
            ], 500);
        }
    
        // 🔹 13. خطأ برمجي (Fatal Error)
        if ($exception instanceof ErrorException) {
           
            return response()->view("errors.any", [
                'code' => 500,
                'error_type' => class_basename($exception),
                'message' => 'A fatal error occurred!'
            ], 500);
        }
    
        // ❌ إذا لم يتم التقاط الخطأ أعلاه، يتم استخدام المعالجة الافتراضية
        return parent::render($request, $exception);


        // $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        // // 🔹 تحديد نوع الخطأ
        // $errorType = class_basename($exception);
        // $message = config('app.debug') ? $exception->getMessage() : 'حدث خطأ غير متوقع، يرجى المحاولة لاحقًا.';

        // // ✅ تسجيل الخطأ في Log
        // \Log::error("Error: {$message}", [
        //     'exception' => get_class($exception),
        //     'status_code' => $statusCode,
        //     'file' => $exception->getFile(),
        //     'line' => $exception->getLine(),
        //     'trace' => $exception->getTraceAsString(),
        // ]);

        // // ✅ **إرجاع صفحة الخطأ**
        // return response()->view("errors.any", [
        //     'code' => $statusCode,
        //     'error_type' => $errorType,
        //     'message' => $message
        // ], $statusCode);

    }

}
