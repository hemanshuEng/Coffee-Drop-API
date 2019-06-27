<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('postcode');               // post code
            $table->double('longitude', 9, 6);        // longitude of postcode
            $table->double('latitude', 9, 6);         // latitude of postcode
            $table->string('district')->nullable();   // district according postcode
            $table->string('county')->nullable();     // county according postcode
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
