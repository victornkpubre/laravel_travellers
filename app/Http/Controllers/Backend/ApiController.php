<?php

namespace App\Http\Controllers\Backend;

use App\Models\Place;
use App\Models\Client;
use App\Models\Emotion;
use App\Models\Activity;
use App\Models\Festival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Http\Resources\BookingResource;
use App\Http\Resources\EmotionResource;
use App\Http\Resources\FestivalResource;

class ApiController extends Controller
{
    public function getData()
    {
        return response()->json([
            'status' => 200,
            'message' => "success",
            'places' => PlaceResource::collection(Place::all()),
            'festivals' => FestivalResource::collection(Festival::all()),
            'emotions' => EmotionResource::collection(Emotion::all()),
            'activities' => Activity::all()
        ]);
    }



    public function getClientBookings(Request $request, $id)
    {
        $client = Client::findorFail($id);
        return response()->json([
            'status' => 200,
            'message' => "success",
            'bookings' => BookingResource::collection($client->bookings)
        ]);

    }



    //Favorite Places Functions
    public function favoritePlaces(Request $request)
    {
        $client = Client::findorFail($request->client_id);
        return response()->json([
            'status' => 200,
            'message' => "success",
            'places' => PlaceResource::collection($client->places)
        ]);
    }

    public function addFavoritePlace(Request $request)
    {
        $client = Client::findorFail($request->client_id);
        $place = Place::findorFail($request->place_id);
        $client->places()->save($place);

        return response()->json([
            'status' => 200,
            'message' => "success",
        ]);
    }

    public function removeFavoritePlace(Request $request)
    {
        $client = Client::findorFail($request->client_id);
        $client->places()->detach($request->place_id);

        return response()->json([
            'status' => 200,
            'message' => "success",
        ]);
    }



    //Favorite Festivals Functions
    public function favoriteFestivals(Request $request)
    {
        $client = Client::findorFail($request->client_id);
        return response()->json([
            'status' => 200,
            'message' => "success",
            'festivals' => FestivalResource::collection($client->festivals)
        ]);
    }

    public function addFavoriteFestival(Request $request)
    {
        $client = Client::findorFail($request->client_id);
        $festival = Festival::findorFail($request->festival_id);
        $client->festivals()->save($festival);

        return response()->json([
            'status' => 200,
            'message' => "success",
        ]);
    }

    public function removeFavoriteFestival(Request $request)
    {
        $client = Client::findorFail($request->client_id);
        $client->festivals()->detach($request->festival_id);

        return response()->json([
            'status' => 200,
            'message' => "success",
        ]);
    }

}
