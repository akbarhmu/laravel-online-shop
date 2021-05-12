<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(){
        $provinces = Province::all();
        return view('profile.address', ['provinces'=>$provinces]);
    }
}
