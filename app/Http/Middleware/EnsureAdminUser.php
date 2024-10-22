<?php

namespace App\Http\Middleware;

use App\Exceptions\Handlers\UserNotAuthorisedException;
use App\Exceptions\Handlers\UserNotAuthorisedExceptionHandler;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class EnsureAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
            try{
                if ($request->user()->role_id == '2') {
                throw new Exception();
                }
            }
            catch (Exception $e){
                $handler = app()->make(UserNotAuthorisedExceptionHandler::class);
                return $handler->handle($e);
            }

        return $next($request);
    }
}
