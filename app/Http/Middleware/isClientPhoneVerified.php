<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isClientPhoneVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $client = null;
        if($request->has('id')) {
            $client = Client::find($request->id);
        }

        if($request->has('client_id')) {
            $client = Client::find($request->client_id);
        }

        if($client == null){
            return response()->json([
                'status' => -1,
                'message' => "client not found",
            ]);
        }
        else {

            if($client->is_phone_verified == 1){
                return $next($request);
            }
            else {
                return response()->json([
                    'status' => -1,
                    'message' => "Phone is not verified",
                ]);
            }
        }
    }
}
