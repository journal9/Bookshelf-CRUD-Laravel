<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function sendVerificationMail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return Response(['message' => " User already Verified"]);
        }
        $request->user()->sendEmailVerificationNotification();
        return Response(['status' => "Success", 'message' => "Verification Email is sent."], 200);
    }

    public function VerifyEmail(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return Response(['message' => "Email already Verified"]);
        }
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return Response(['status' => "Success", 'message' => "Email Verified"], 200);
    }
}
