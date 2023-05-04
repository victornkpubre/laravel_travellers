<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Backend\NotificationController;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleRedirect()
    {
        $data = Socialite::driver('google')->stateless()->user();
        $user = User::where('email',$data->email)->first();
        if(!$user){
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($data->id);
            $user->phone = 0000000;
            $user->role = 0;
            $user->provider_id = $data->id;
            $user->provider = 'google';
            $user->avatar = $data->avatar;
            $user->save();
        }

        $userVerify = UserVerify::find('user_id', $user->id);
        if(!$userVerify) {
            $token =Str::random(64);
            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token
            ]);
            (new NotificationController)->sendVerificationEmail($token, $user);
        }

        Auth::login($user);
        return redirect("backend.dashboard")->withSuccess('You have signed-in');
    }

}
