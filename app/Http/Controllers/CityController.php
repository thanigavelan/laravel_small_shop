<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\City;


class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    public function cityInfoPage()
    {
        return view('city-deatails');
    }

    public function getCity($cityName)
    {
        $city = City::where('name' , $cityName)->with('state.country')->first();

        if($city) {
            $state = $city->state;
            $country = $state->country;

            return response()->json([
                'city'  => $city,
                'state' => $state,
                'country' => $country,
            ]);
        }
    }

    public function showCityDetails($cityName)
    {
        $city = City::where('name', $cityName)->with('state.country')->first();
        if($city)
        {
            $state = $city->state;
            $country = $state->country;

            return view ('frontend/city-details', compact('city', 'state','country'));
        
        }
        else{
            return view('frontend/city-not-found');
        }
    }
}