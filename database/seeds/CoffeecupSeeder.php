<?php

use App\Price;
use App\Coffeecup;
use Illuminate\Database\Seeder;

class CoffeecupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coffeecup1 = Coffeecup::create(['coffeecup' => 'Ristretto']);
        Price::create([
            'coffeecup_id' => $coffeecup1->id,
            'min' => 0,
            'max' => 50,
            'pence' => 2
        ]);
        Price::create([
            'coffeecup_id' => $coffeecup1->id,
            'min' => 51,
            'max' => 500,
            'pence' => 3
        ]);
        Price::create([
            'coffeecup_id' => $coffeecup1->id,
            'min' => 501,
            'max' => 999999,
            'pence' => 5
        ]);
        $coffeecup2 = Coffeecup::create(['coffeecup' => 'Espresso']);
        Price::create([
            'coffeecup_id' => $coffeecup2->id,
            'min' => 0,
            'max' => 50,
            'pence' => 4
        ]);
        Price::create([
            'coffeecup_id' => $coffeecup2->id,
            'min' => 51,
            'max' => 500,
            'pence' => 6
        ]);
        Price::create([
            'coffeecup_id' => $coffeecup2->id,
            'min' => 501,
            'max' => 999999,
            'pence' => 10
        ]);
        $coffeecup3 = Coffeecup::create(['coffeecup' => 'Lungo']);
        Price::create([
            'coffeecup_id' => $coffeecup3->id,
            'min' => 0,
            'max' => 50,
            'pence' => 6
        ]);
        Price::create([
            'coffeecup_id' => $coffeecup3->id,
            'min' => 51,
            'max' => 500,
            'pence' => 9
        ]);
        Price::create([
            'coffeecup_id' => $coffeecup3->id,
            'min' => 501,
            'max' => 999999,
            'pence' => 15
        ]);
    }
}
