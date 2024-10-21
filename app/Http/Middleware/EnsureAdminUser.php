<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     // $user_id = auth()->id();
    //     $user = $request->user();
    //     echo $request;
    //     return Response($request);
    //     // $user = User::whereId($user_id)->first();
    //     if($user->role_id == '2'){
    //         return Response([
    //             'status'=>"failure",
    //             'message'=>"User not authorised"
    //         ],401);
    //     }
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        if ($request->user()->role_id == '2') {
            return Response([
                'status'=>"failure",
                'message'=>"User not authorised"
            ],401);
        }

        return $next($request);
    }
}
