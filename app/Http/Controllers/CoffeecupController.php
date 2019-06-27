<?php

namespace App\Http\Controllers;

use App\Coffeecup;
use Illuminate\Http\Request;
use App\Http\Requests\CoffeecupRequest;
use Symfony\Component\HttpFoundation\Response;

class CoffeecupController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function amount(CoffeecupRequest $request)
    {
        $total_amount = 0;
        foreach ($request->all() as $key => $cups) {
            $coffeecup = CoffeeCup::where('coffeecup', $key)->first();
            $pence = $coffeecup->price->where('max', '>=', $cups)->where('min','<=',$cups)->first()->pence;
            $total_amount += ($cups * $pence);
        }
        return response([
            'data' => ['coffepod' => $request->all(), 'Cashback_pound' => $total_amount / 100]
        ], Response::HTTP_CREATED);
    }
}
