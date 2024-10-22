<?php

namespace App\Providers;

use App\Exceptions\Handlers\UserNotAuthorisedExceptionHandler;
use App\Interfaces\ExceptionHandlerInterface;
use Illuminate\Support\ServiceProvider;

class AdminExceptionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ExceptionHandlerInterface::class,UserNotAuthorisedExceptionHandler::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
