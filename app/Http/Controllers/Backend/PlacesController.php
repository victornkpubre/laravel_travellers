<?php

namespace App\Http\Controllers\Backend;

use App\Models\Place;
use App\Models\Activity;
use App\Models\Festival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlaceResource;
use App\Http\Requests\PlaceStoreRequest;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $places = Place::all();
        if($request->has("search") ) {

            $places = Place::where("name", "like", "%{$request->search}%")->get();
            // dd($places);
        }
        return PlaceResource::collection($places);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceStoreRequest $request)
    {

        $image_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path().'/images/places/',$image_name);
        $validatedData = $request->validated();
        $validatedData['img'] =  "places/".$image_name;

        $place = Place::create($validatedData);
        return back()->with("message", "Department Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return new PlaceResource($place);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceStoreRequest $request, Place $place)
    {
        // dd($request);
        $validatedData = $request->validated();
        if( $request->file('image') != null) {
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/images/places/',$image_name);
            $validatedData['img'] =  "places/".$image_name;
        }

        $place->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return response()->json("The Place: ".$place->name." was Deleted");
    }

    public function addActivity(Request $request){
        $place = Place::findOrFail($request->place_id);
        $activity = Activity::findOrFail($request->activity_id);

        $place->activities()->save($activity);
    }

    public function removeActivity(Request $request){
        $place = Place::findOrFail($request->place_id);
        $place->activities()->detach($request->activity_id);
    }
}
