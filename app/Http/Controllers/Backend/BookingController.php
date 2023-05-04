<?php

namespace App\Http\Controllers\Backend;

use App\Models\Place;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Activity;
use App\Models\Festival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Http\Requests\BookingStoreRequest;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = Booking::all();
        if($request->has("search") ) {
            $bookings = [];
            $clients = Client::where("first_name", "like", "%{$request->search}%")->orWhere("last_name", "like", "%{$request->search}%")->get();
            foreach ($clients as $client) {
                $bookings.push(Booking::where("client_id", $client->id)->get());
            }
        }
        return BookingResource::collection($bookings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = Booking::create(['client_id' => $request->client_id]);

        foreach ($request["festivals"] as $festival) {
            $this->addFestival($booking->id, $festival["id"]);
        }
        foreach ($request["places"] as $place) {
            $this->addPlace($booking->id, $place["id"]);
        }
        foreach ($request["activities"] as $activity) {
            $this->addActivity($booking->id, $activity["id"]);
        }
    }

    public function storeMobile(Request $request)
    {
       
        $booking = Booking::create(['client_id' => $request->client_id]);

        foreach ($request["festivals"] as $festival_id) {
            $this->addFestival($booking->id, $festival_id);
        }
        foreach ($request["places"] as $place_id) {
            $this->addPlace($booking->id, $place_id);
        }
        foreach ($request["activities"] as $activity_id) {
            $this->addActivity($booking->id, $activity_id);
        }

        return response()->json([
            'status' => 200,
            'message' => "success",
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return new BookingResource($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $booking->update(['client_id' => $request->client_id]);
        $booking->festivals()->detach();
        $booking->places()->detach();
        $booking->activities()->detach();
        foreach ($request["festivals"] as $festival) {
            $this->addFestival($booking->id, $festival["id"]);
        }
        foreach ($request["places"] as $place) {
            $this->addPlace($booking->id, $place["id"]);
        }
        foreach ($request["activities"] as $activity) {
            $this->addActivity($booking->id, $activity["id"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json("The Client: ".$client->name." was Deleted");
    }

    public function addFestival($bookings_id, $festival_id) {
        $booking = Booking::findOrFail($bookings_id);
        $activity = Festival::findOrFail($festival_id);
        $booking->festivals()->save($activity);
    }

    public function removeFestival($bookings_id, $festival_id){
        $booking = Booking::findOrFail($bookings_id);
        $booking->festivals()->detach($festival_id);
    }

    public function addPlace($bookings_id, $place_id) {
        $booking = Booking::findOrFail($bookings_id);
        $place = Place::findOrFail($place_id);
        $booking->places()->save($place);
    }

    public function removePlace($bookings_id, $place_id){
        $booking = Booking::findOrFail($bookings_id);
        $booking->places()->detach($place_id);
    }

    public function addActivity($bookings_id, $activity_id) {
        $booking = Booking::findOrFail($bookings_id);
        $activity = Activity::findOrFail($activity_id);
        $booking->activities()->save($activity);
    }

    public function removeActivity($bookings_id, $activity_id){
        $booking = Booking::findOrFail($bookings_id);
        $booking->activities()->detach($activity_id);
    }



}
