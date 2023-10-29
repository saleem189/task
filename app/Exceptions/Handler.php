<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Response;


class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(static function (AuthenticationException $_) {
            throw new UnauthenticatedException();
        });

        $this->renderable(static function (CustomBaseException $e) {
            $responseBody = [
                'code' => $e->getCode(),
                'code_string' => $e->getCodeStr(),
                'message' => $e->getMessage(),
            ];

            if (true === config('app.debug')) {
                $responseBody['file'] = $e->getFile();
                $responseBody['line'] = $e->getLine();
                $responseBody['exception'] = get_class($e);
                $responseBody['trace'] = $e->getTrace();
            }

            return Response::json($responseBody, $e->getHttpStatusCode());
        });
    }
}
