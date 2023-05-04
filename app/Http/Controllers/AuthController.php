<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Backend\NotificationController;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->to('backend.dashboard')->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('auth.register');
    }


    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
        ]);

        $data = $request->all();
        $this->create($data);

        return redirect("backend.dashboard")->withSuccess('You have signed-in');
    }


    protected function create(array $data)
    {
        // dd($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone'=> $data['phone'],
        ]);

        $token =Str::random(64);
        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        (new NotificationController)->sendVerificationEmail($token, $user);
        Auth::login($user);
    }

    public function signOut() {
        // Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function dashboard()
    {
        return Redirect::to('/places');
    }

    public function verifyAccountEmail($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
        $message = 'Email cannot be identified';
        if(!is_null($verifyUser)) {
            $user = User::find($verifyUser->user_id);
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Email Verified";
            }
            else {
                $message = "Email Alreay Verified";
            }
        }

        Auth::login($user);
        return redirect()->route('home', ['message' => $message]);
    }

    public function verifyClientAccountEmail($token)
    {
        $verifyClient = ClientVerify::where('token', $token)->first();
        $message = 'Email cannot be identified';
        if(!is_null($verifyClient)) {
            $client = Client::find($verifyClient->client_id);
            if(!$client->is_email_verified) {
                $verifyClient->client->is_email_verified = 1;
                $verifyClient->client->save();
                $message = "Email Verified";
            }
            else {
                $message = "Email Alreay Verified";
            }
        }

        return redirect()->route('home', ['message' => $message]);
    }


}
