<?php

namespace App\Providers;

use App\Exceptions\Handlers\UniqueConstraintViolationExceptionHandler;
use App\Exceptions\Handlers\UserNotAuthorisedExceptionHandler;
use App\Interfaces\ExceptionHandlerInterface;
use Illuminate\Support\ServiceProvider;

class EsceptionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ExceptionHandlerInterface::class,UniqueConstraintViolationExceptionHandler::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
