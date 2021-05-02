<?php

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('city')->group(function () {
    Route::get('/', function () {
        $cities = City::all();
        return response()->json($cities);
    });

    Route::get('/{id}', function ($id) {
        $city = City::where('id',$id)->get();
        return response()->json($city);
    });

    Route::get('/by-province/{id}', function ($id) {
        $city = City::where('province_id',$id)->get();
        return response()->json($city);
    });
});

Route::prefix('province')->group(function () {
    Route::get('/', function () {
        $provinces = Province::all();
        return response()->json($provinces);
    });

    Route::get('/{id}', function ($id) {
        $province = Province::where('province_id',$id)->get();
        return response()->json($province);
    });
});
