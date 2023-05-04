<?php

namespace App\Http\Controllers\Backend;

use App\Models\Place;
use App\Models\Emotion;
use App\Models\Activity;
use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmotionResource;
use App\Http\Requests\EmotionStoreRequest;

class EmotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $emotions = Emotion::all();
        if($request->has("search") ) {

            $emotions = Emotion::where("img", "like", "%{$request->search}%")->get();

            // $authors = Author::whereHas('books', function (Builder $query) {
            //    $query->where('title', 'like', 'PHP%');
            // })->get();

        }
        return EmotionResource::collection($emotions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmotionStoreRequest $request)
    {
        $image_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path().'/images/emotions/',$image_name);
        $validatedData = $request->validated();
        $validatedData['img'] =  "emotions/".$image_name;

        $emotion = Emotion::create($validatedData);
        return back()->with("message", "Department Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Emotion $emotion)
    {
        return new EmotionResource($emotion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmotionStoreRequest $request, Emotion $emotion)
    {
        $validatedData = $request->validated();
        if( $request->file('image') != null){
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/images/emotions/',$image_name);
            $validatedData['img'] =  "emotions/".$image_name;
        }

        if($request->has("activity_id")){
            $activity = Activity::findOrFail($validatedData['activity_id']);
            $emotion->activity()->associate($activity);
            $emotion->save();
        }
        if($request->has("place_id")){
            $place = Place::findOrFail($validatedData['place_id']);
            $emotion->place()->associate($place);
            $emotion->save();
        }
        if($request->has("festival_id")){
            $festival = Festival::findOrFail($validatedData['festival_id']);
            $emotion->festival()->associate($festival);
            $emotion->save();
        }

        $emotion->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emotion $emotion)
    {
        $emotion->delete();
        return response()->json("The Place: ".$emotion->img." was Deleted");
    }


    public function removeAssociation(Request $request){
        $emotion = Emotion::findOrFail($request->emotion_id);
        if($request->relation == 'activity'){
            $emotion->activity()->dissociate()->save();
            dd($emotion);
        }
        if($request->relation == 'place'){
            $place = Place::findOrFail($request->id);
            $place->emotions()->detach($emotion->id);
        }
        if($request->relation == 'festival'){
            $festival = Festival::findOrFail($request->id);
            $festival->emotions()->detach($emotion->id);
        }
    }
}
