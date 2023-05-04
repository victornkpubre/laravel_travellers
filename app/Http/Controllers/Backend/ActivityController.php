<?php

namespace App\Http\Controllers\Backend;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Requests\ActivityStoreRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activities = Activity::all();
        if($request->has("search") ) {

            $activities = Activity::where("name", "like", "%{$request->search}%")->get();

        }
        return ActivityResource::collection($activities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityStoreRequest $request, Activity $activity)
    {
        $image_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path().'/images/activities/',$image_name);
        $validatedData = $request->validated();
        $validatedData['img'] =  "activities/".$image_name;

        $activity = Activity::create($validatedData);
        return back()->with("message", "Department Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return new ActivityResource($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityStoreRequest $request, Activity $activity)
    {
        $validatedData = $request->validated();
        if( $request->file('image') != null){
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/images/activities/',$image_name);
            $validatedData['img'] =  "activities/".$image_name;
        }

        $activity->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return response()->json("The Place: ".$activity->name." was Deleted");
    }
}
