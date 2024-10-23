<?php

namespace App\Exceptions\Handlers;

use App\Interfaces\ExceptionHandlerInterface;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\JsonResponse;
use Throwable;

class UniqueConstraintViolationExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(Throwable $exception): JsonResponse
    {
        return response()->json([
            'status' => 'failure',
            'message' => $this->getMessage($exception),
        ], $this->getStatusCode($exception));
    }

    public function getMessage(Throwable $exception): string
    {
        return 'An email with this value already exists.';
    }

    public function getStatusCode(Throwable $exception): int
    {
        return 400;
    }
}