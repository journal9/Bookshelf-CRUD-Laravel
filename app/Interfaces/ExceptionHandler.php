<?php
namespace App\Interfaces;

use Throwable;
use Illuminate\Http\JsonResponse;

interface ExceptionHandlerInterface
{
    public function handle(Throwable $exception): JsonResponse;
    public function getMessage(Throwable $exception): string;
    public function getStatusCode(Throwable $exception): int;
}
