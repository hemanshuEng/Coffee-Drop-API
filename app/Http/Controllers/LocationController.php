<?php

namespace App\Http\Controllers;

use App\Location;
use App\Timetable;
use Illuminate\Http\Request;
use Jabranr\PostcodesIO\PostcodesIO;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LocationResource::collection(Location::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $postcodeFinder = new PostcodesIO();
        $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
        $result = $postcodeFinder->find($request->postcode);
        $location = new Location;
        $location->postcode = $request->postcode;
        $location->longitude = $result->result->longitude;
        $location->latitude = $result->result->latitude;
        $location->district = $result->result->admin_district;
        $location->county = $result->result->admin_ward;
        $location->save();

        for ($i = 1; $i < 8; $i++) {
            $timetable = new Timetable;
            $day = $days[$i - 1];

            if (array_key_exists($day, $request->opening_times)) {
                $timetable->day = $i - 1;
                $timetable->open = $request->opening_times[$day];
                $timetable->closed  = $request->closing_times[$day];
            } else {
                $timetable->day = $i - 1;
                $timetable->open = null;
                $timetable->closed  = null;
            }

            $location->timetable()->save($timetable);
        }

        return response([
            'data' => $location
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
