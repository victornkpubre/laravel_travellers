<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    // public function verifyAccountEmail($token)
    // {
    //     $verifyUser = UserVerify::where('token', $token)->first();
    //     $message = 'Email cannot be identified';
    //     if(!is_null($verifyUser)) {
    //         $user = $verifyUser->user;
    //         if(!$user->is_email_verified) {
    //             $verifyUser->user->is_email_verified = 1;
    //             $verifyUser->user->save();
    //             $message = "Email Verified";
    //         }
    //         else {
    //             $message = "Email Alreay Verified";
    //         }
    //     }
    //     $user = User::where('id', $verifyUser->user_id)->get();
    //     Auth::login($user);
    //     return redirect()->route('home', ['message' => $message]);
    // }

}
