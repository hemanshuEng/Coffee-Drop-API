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

    private function get_location_near($latitude, $longitude, $radius = 100)
    {

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
        $postcode = $request->postcode;
        if ($postcode == null) {
            return response([
                'data' => 'No Postcode entered'
            ], Response::HTTP_OK);
        }

        $postcodeFinder = new PostcodesIO();
        try {
            $geolocation = $postcodeFinder->find($request->postcode);
            $closestlocation = $this->get_location_near($geolocation->result->latitude, $geolocation->result->longitude);
            return response([
                'closestlocation' => new LocationResource($closestlocation),
                'distance' => $closestlocation->distance
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response([
                'data' => 'Postcode is not valid',
                'error' => $e->getMessage()
            ], Response::HTTP_OK);
        }
    }
}
