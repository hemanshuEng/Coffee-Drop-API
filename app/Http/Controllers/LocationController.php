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
        /**
         * responce all location time in pagination
         */
        return LocationResource::collection(Location::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {

        /**
         *  check if postcode already exits ?
         */
        if (Location::where('postcode', $request->postcode)->exists()) {
            //return response
            return response([
                'message' => 'Postcode already exist!',
            ], Response::HTTP_OK);
        }
        /**
         *   class to find geoloaction information
         */
        $postcodeFinder = new PostcodesIO();

        // array to find intenger value for days
        $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
        try {

            /**
             *  find data about location and store into location table
             *
             */
            $result = $postcodeFinder->find($request->postcode); // api call

            $location = new Location;
            $location->postcode = $request->postcode;
            $location->longitude = $result->result->longitude;
            $location->latitude = $result->result->latitude;
            $location->district = $result->result->admin_district;
            $location->county = $result->result->admin_ward;
            $location->save();  //storing data

            for ($i = 0; $i < 7; $i++) {
                //create object to store time data
                $timetable = new Timetable;
                $day = $days[$i];

                // if key exists then time would be added otherwise null
                if (array_key_exists($day, $request->opening_times)) {
                    $timetable->day = $i;
                    $timetable->open = $request->opening_times[$day];
                    $timetable->closed  = $request->closing_times[$day];
                } else {
                    $timetable->day = $i;
                    $timetable->open = null;
                    $timetable->closed  = null;
                }

                // eloquent to store timetable data related to location
                $location->timetable()->save($timetable);
            }

            return response([
                'data' => $location,
                'message' => 'New location has been added'
            ], Response::HTTP_CREATED);
        }
        // if error occur during api calls
        catch (\Exception $e) {

            return response([
                'message' => 'Postcode is not valid',
            ], Response::HTTP_OK);
        }
    }

    /**
     * function get_location_near()
     * using Haversine formula it calculates and find nearest location form database
     *  distance is in miles
     */
    private function get_location_near($latitude, $longitude, $radius = 100)
    {
        //query
        $result = Location::select('*')
            ->selectRaw('( 3959 * acos( cos( radians(?) ) *
                               cos( radians( latitude ) )
                               * cos( radians( longitude ) - radians(?)
                               ) + sin( radians(?) ) *
                               sin( radians( latitude ) ) )
                             ) AS distance', [$latitude, $longitude, $latitude])
            ->havingRaw("distance < ?", [$radius])->orderBy("distance")
            ->first();

        return $result;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find_near_location(Request $request)
    {
        /**
         * check if postcode is not empty
         *
         */
        $postcode = $request->postcode;

        if ($postcode == null) {
            return response([
                'message' => 'No Postcode entered'
            ], Response::HTTP_OK);
        }

        $postcodeFinder = new PostcodesIO(); // api call for postcode

        try {
            //find geo information from api call
            $geolocation = $postcodeFinder->find($request->postcode);
            //using mehtods first nearest location data
            $closestlocation = $this->get_location_near($geolocation->result->latitude, $geolocation->result->longitude);
            //return responce
            return response([
                // responce format using LocationResource and opening and closing time added
                'closestlocation' => new LocationResource($closestlocation),
                'distance' => $closestlocation->distance
            ], Response::HTTP_OK);

            // if erro occurs then responce
        } catch (\Exception $e) {
            return response([
                'data' => 'Postcode is not valid',
                'error' => $e->getMessage()
            ], Response::HTTP_OK);
        }
    }
}
