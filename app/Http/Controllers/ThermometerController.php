<?php

namespace App\Http\Controllers;

class ThermometerController extends Controller
{
    public function index()
    {
        $temperature = app('redis')->get('temperature');
        $temperature = str_replace("'", '"', $temperature);
        $temperature = json_decode($temperature, true);

        $humidity = app('redis')->get('humidity');
        $humidity = str_replace("'", '"', $humidity);
        $humidity = json_decode($humidity, true);

        return \Respond::succeed([
            "temperature" => $temperature['value'],
            "humidity" => $humidity['value'],
            "updated_at" => $temperature['created_at']
        ]);
    }
}
