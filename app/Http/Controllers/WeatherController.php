<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gmopx\LaravelOWM\LaravelOWM;


class WeatherController extends Controller
{
    /**
     * Return the weather and temperature for the given coordinates
     *
     * @return \Illuminate\Http\Response
     */
    public function getWeather(Request $request)
    {
        $lowm = new LaravelOWM();
        $query = $request->coordinates; //coord: ['lat': -0.13, 'lon': 51.51]

        try {
            $current_weather = $lowm->getCurrentWeather($query, 'en', 'metric', false);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
        
        $return_json = array();
        $return_json['weather'] = $current_weather->weather;
        $return_json['temperature'] = $current_weather->temperature->now;

        return Response()->json($return_json);
    }
}