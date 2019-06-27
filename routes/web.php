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

    $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
    $test = array('sunday' => 19, 'monday' => 20);
    for ($i = 1; $i < 8; $i++) {
        $day = $days[$i - 1];
        if (array_key_exists($day, $test)) {
            //$timetable->location_id = $location->id;
            echo $day;
        } else {
            //$timetable->location_id = $location->id;
            echo $day;
        }
    }
    //return view('welcome');
});
