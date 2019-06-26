<?php

use League\Csv\Reader;
use League\Csv\Statement;
use Jabranr\PostcodesIO\PostcodesIO;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $postcodeFinder = new PostcodesIO();
    $csv = Reader::createFromPath(storage_path('location_data.csv'), 'r');
    $csv->setHeaderOffset(0);


    $stmt = (new Statement());

    $records = $stmt->process($csv);
    foreach ($records as $key => $record) {
        try {
            $addresses = $postcodeFinder->find($record['postcode']);
            $arrkey = array_keys($record);

            for ($i = 0; $i < 7; $i++) {
                echo $record[$arrkey[$i + 1]];
                echo "<br>";
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
   
    //return view('welcome');
});
