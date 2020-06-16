<?php

namespace App\Exceptions;

use App\Exceptions\Custom\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        switch (true){
            case ($exception instanceof ValidationException):
                return response()->json([
                    'status' => 'error',
                    'error' => $exception->getMessage(),
                ], 422);

            case ($exception instanceof AuthenticationException):
                return response()->json([
                    'status' => 'error',
                    'error' => 'Not Authenticate',
                ], 401);
            default:
                return parent::render($request, $exception);
        }
    }
}
