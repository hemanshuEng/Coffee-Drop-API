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
        $postcodeFinder = new PostcodesIO();

        $csv = Reader::createFromPath(storage_path('location_data.csv'), 'r');
        $csv->setHeaderOffset(0);

        $stmt = (new Statement());
        $records = $stmt->process($csv);
        foreach ($records as $key => $record) {
            try {
                $result = $postcodeFinder->find($record['postcode']);
                $location_data = [];
                $location_data['postcode'] = $record['postcode'];
                $location_data['longitude'] = $result->result->longitude;
                $location_data['latitude'] = $result->result->latitude;
                $location_data['district'] = $result->result->admin_district;
                $location_data['county'] = $result->result->admin_ward;
                $location = Location::create($location_data);

                $arrkey = array_keys($record);
                for ($i = 0; $i < 7; $i++) {
                    $time = \App\Timetable::create([
                        'location_id' => $location->id,
                        'day' => $i,
                        'open' => $record[$arrkey[$i + 1]] ? $record[$arrkey[$i + 1]] : null,
                        'closed' => $record[$arrkey[$i + 8]] ? $record[$arrkey[$i + 8]] : null,
                    ]);
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        //
    }
}


