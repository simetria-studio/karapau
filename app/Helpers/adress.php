<?php

use App\Models\AdressBuyer;
use App\Models\ShippingTax;
use Darryldecode\Cart\Cart;



function getValue($portoId)
{


    $adress = App\Models\AdressBuyer::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
    $porto = App\Models\Porto::find($portoId);
    $kmValor = App\Models\Km::orderBy('created_at', 'desc')->first();
// print_r($porto);
    $url =  Illuminate\Support\Facades\Http::get("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$porto->latitude,$porto->longitude&destinations=$adress->latitude,$adress->longitude&key=AIzaSyCcTnukB7zVZVr3T-Pk6-Lptswge0BDOXg");


    $collection = collect(json_decode($url, true));

    $dist = $collection['rows'][0]['elements'][0]['distance']['text'];
    $distF = (float)$dist;
    $distC = $distF;
    $mnH = $distC * 1.609;
    // print_r($adress);
    // print_r($url);

    return $mnH * (float)$kmValor->km;


}
