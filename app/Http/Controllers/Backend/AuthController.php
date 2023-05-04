<?php

namespace App\Http\Controllers\Backend;

use App\Models\Client;
use Illuminate\Support\Str;
use App\Models\ClientVerify;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Backend\NotificationController;

class AuthController extends Controller
{
    function login(LoginRequest $request) {
        $validatedData = $request->validated();
        $client = Client::where('email', $request->email)->first();

        if (! $client || ! Hash::check($request->password, $client->password)) {
            return response()->json([
                'status' => 408,
                'message' => "error",
                'error' => "wrong credentials check your password and email",
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => "success",
            'token' => $client->createToken($request->device_name)->plainTextToken,
            'user' => $client
        ]);

    }

    function register(RegisterRequest $request) {
        $request->validated();

        $client = Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone'=> $request->phone,
        ]);

        $token =Str::random(64);
        ClientVerify::create([
            'client_id' => $client->id,
            'token' => $token
        ]);

        (new NotificationController)->sendClientVerificationEmail($token, $client);

        return response()->json([
            'status' => 200,
            'message' => "success",
            'token' => $client->createToken($request->device_name)->plainTextToken,
            'user' => $client
        ]);

    }

    function logout(Request $request) {
        $client = Client::where('email', $request->email)->first();
        if($client){
            $client->tokens()->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => "success",
        ]);
    }

    function reset(Request $request) {
        $client = Client::where('email', $request->email)->first();

        if (! $client || ! Hash::check($request->password, $client->password)) {
            return response()->json([
                'status' => 408,
                'message' => "wrong credentials check your password"
            ]);
        }

        $client->password = Hash::make($request->new_password);
        $client->save();

        return response()->json([
            'status' => 200,
            'message' => "success"
        ]);

    }

    // public function userVerified(Request $request) {
    //     $request->validate([
    //         'id' => 'required',
    //     ]);
    //     $user = Client::find($request->id);
    //     return response()->json([
    //         'status' => 200,
    //         'message' => "success",
    //         'data' => $user->is_phone_verified
    //     ]);

    // }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'phone' => 'required',
        ]);
        //Generate Otp
        $otp = random_int(100000, 999999);
        //Store Otp
        $user = Client::find($request->id);
        $user->otp = $otp;
        $user->save();
        $result = json_decode($this->sendOtp($otp, $request->phone));
        if(isset($result->data)) {
            return response()->json([
                'status' => 200,
                'message' => "Otp sent"
            ]);
        }
        else {
            return response()->json([
                'status' => 200,
                'message' => $result->error->message
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'otp' => 'required',
        ]);

        $user = Client::find($request->id);
        if($request->otp == $user->otp) {
            $user->is_phone_verified = 1;
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => "success"
            ]);
        }
        else {
            return response()->json([
                'status' => 408,
                'message' => "wrong otp"
            ]);
        }
    }



    protected function sendOtp($otp, $phone)
    {
        $json = json_encode([
            "body" => "Your one time pass is ".$otp,
            "from" => "Travellers",
            "to" => "".$phone,
            "api_token" => "".Config::get('app.sms'),
            "gateway" => "direct-refund"
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.bulksmsnigeria.com/api/v2/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "".$json."",
        CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return  $response;
    }


    public function googleLogin(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'sub' => 'required',
        ]);
        $user = Client::where('email', $request->email)->first();

        if(!$user) {
            $user = new Client();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->sub);
            $user->phone = 0000000;
            $user->save();

            $token =Str::random(64);
            ClientVerify::create([
                'client_id' => $client->id,
                'token' => $token
            ]);

            (new NotificationController)->sendClientVerificationEmail($token, $client);
        }

        return response()->json([
            'status' => 200,
            'message' => "success",
            'token' => $user->createToken($request->email)->plainTextToken,
            'user' => $user
        ]);
    }

}
