<?php

use App\Location;
use App\Timetable;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Database\Seeder;
use Jabranr\PostcodesIO\PostcodesIO;
use PhpParser\Node\Expr\Cast\Double;

class LocationSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *  lag and lat ,district and county information form api call using PostcodesIO class
         *
         */
        $postcodeFinder = new PostcodesIO();

        /**
         * location_data.csv file in storage folder
         * laravel package
         * CSV.thephpleague [Documentation](https://csv.thephpleague.com/)
         *
         */
        //reading file
        $csv = Reader::createFromPath(storage_path('location_data.csv'), 'r');
        // first row is title set the CSV header offset
        $csv->setHeaderOffset(0);

        $stmt = (new Statement());

        $records = $stmt->process($csv);

        foreach ($records as $key => $record) {
            try {
                // api call for postcode.io
                $result = $postcodeFinder->find($record['postcode']);
                $location_data = [];     //empty array

                $location_data['postcode'] = $record['postcode'];
                $location_data['longitude'] = $result->result->longitude;
                $location_data['latitude'] = $result->result->latitude;
                $location_data['district'] = $result->result->admin_district;
                $location_data['county'] = $result->result->admin_ward;

                // insert data into location database
                $location = Location::create($location_data);


                $arrkey = array_keys($record);

                // location's timetable
                for ($i = 0; $i < 7; $i++) {
                    $time = \App\Timetable::create([
                        'location_id' => $location->id, // location id
                        'day' => $i,                   // day is saved in integer (sunday=0 , monday=1)
                        //if there is no time in .csv then null would be palced
                        'open' => $record[$arrkey[$i + 1]] ? $record[$arrkey[$i + 1]] : null,
                        'closed' => $record[$arrkey[$i + 8]] ? $record[$arrkey[$i + 8]] : null,
                    ]);
                }
            } catch (\Exception $e) {
                // if any error happen during api call Error message will be displayed
                echo $e->getMessage();
            }
        }
        //
    }
}
