<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CekResiController extends Controller
{
    public static function getApiCekResi($courier,$awb){
        $kurir = $courier;
        $awb = $awb;
        $api_key = env('BINDERBYTE_API_KEY', 'null');
        $response = Http::get('https://api.binderbyte.com/v1/track?api_key='.$api_key.'&courier='.$kurir.'&awb='.$awb.'')
                            ->json();
        return $response;
    }
}
