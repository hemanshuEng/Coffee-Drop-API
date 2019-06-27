<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //json column type is not supported in mariadb ,storing individual amount storage
        Schema::create('api_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('ip')->index();  // ip address
            $table->integer('ristetto');       // json column type is not supported in mariadb
            $table->integer('espresso');       // json column type is not supported in mariadb
            $table->integer('lungo');          // json column type is not supported in mariadb
            $table->string('agent');           // browser
            $table->float('cashBack');         // total cashback
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
        Schema::dropIfExists('api_logs');
    }
}
