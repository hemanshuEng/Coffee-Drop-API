<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         *  location seeder and Coffeecup seeder
         */
         $this->call(LocationSeeder::class);
         $this->call(CoffeecupSeeder::class);
    }
}
