<?php

namespace App\Http\Controllers\Backend;

use App\Models\Activity;
use App\Models\Festival;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FestivalResource;
use App\Http\Requests\FestivalStoreRequest;

class FestivalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $festivals = Festival::all();
        if($request->has("search") ) {

            $festivals = Festival::where("name", "like", "%{$request->search}%")->get();
            // dd($places);
        }
        return FestivalResource::collection($festivals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FestivalStoreRequest $request)
    {
        $image_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path().'/images/festivals/',$image_name);
        $validatedData = $request->validated();
        $validatedData['img'] =  "festivals/".$image_name;

        $festival = Festival::create($validatedData);
        return back()->with("message", "Department Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Festival $festival)
    {
        return new FestivalResource($festival);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FestivalStoreRequest $request, Festival $festival)
    {
        $validatedData = $request->validated();
        if( $request->file('image') != null){
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/images/festivals/',$image_name);
            $validatedData['img'] =  "festivals/".$image_name;
        }

        $festival->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Festival $festival)
    {
        $festival->delete();
        return response()->json("The Festival: ".$festival->name." was Deleted");
    }

    public function addActivity(Request $request) {
        $festival = Festival::findOrFail($request->festival_id);
        $activity = Activity::findOrFail($request->activity_id);

        $festival->activities()->save($activity);
    }

    public function removeActivity(Request $request){
        $festival = Festival::findOrFail($request->festival_id);
        $festival->activities()->detach($request->activity_id);
    }
}
