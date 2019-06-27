<?php

namespace App\Http\Controllers;

use App\ApiLog;

use App\Coffeecup;
use App\Http\Requests\CoffeecupRequest;
use Symfony\Component\HttpFoundation\Response;

class CoffeecupController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CoffeecupRequest
     * @return \Illuminate\Http\Response
     */
    public function amount(CoffeecupRequest $request)
    {
        $cashback = 0;
        foreach ($request->all() as $key => $cups) {
            $coffeecup = CoffeeCup::where('coffeecup', $key)->first();
            $pence = $coffeecup->price->where('max', '>=', $cups)->where('min', '<=', $cups)->first()->pence;
            $cashback += ($cups * $pence);
        }
        // new object to add request to ApiLog database
        $amount = $request->all();
        $apilog = new ApiLog();
        $apilog->ip = \Request::ip(); // get IP address
        $apilog->agent = $_SERVER['HTTP_USER_AGENT']; // browser
        // json is not supported by mariadb
        $apilog->ristetto = $amount['Ristretto'];
        $apilog->espresso = $amount['Espresso'];
        $apilog->lungo  = $amount['Lungo'];
        $apilog->cashback = ($cashback / 100);
        $apilog->save();

        return response([
            'data' => ['coffeepod' => $request->all(), 'Cashback' => "You will be receive £ " . ($cashback / 100)]
        ], Response::HTTP_OK);
    }
}
