<?php

namespace App\Exceptions;

use App\Interfaces\ExceptionHandlerInterface;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Exceptions\Handlers\UniqueConstraintViolationExceptionHandler;
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
    protected $exceptionMap = [
        UniqueConstraintViolationException::class => UniqueConstraintViolationExceptionHandler::class
    ];

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            $handler = $this->getExceptionHandler($exception);
            if ($handler) {
                return $handler->handle($exception);
            }
        }

        return parent::render($request, $exception);
    }

    private function getExceptionHandler(Throwable $exception): ?ExceptionHandlerInterface
    {
        foreach ($this->exceptionMap as $exceptionClass => $handlerClass) {
            if ($exception instanceof $exceptionClass) {
                return app()->make($handlerClass);
            }
        }
        return null;
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
