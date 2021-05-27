<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Province;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(){
        $provinces = Province::all();
        return view('profile.address', ['provinces'=>$provinces]);
    }

    public function update(AddressRequest $request){
        $validatedData = $request->validated();

        try{
            $user = User::find(Auth::user()->id);
            $user->address = $validatedData['address'];
            $user->province_id = $validatedData['province_id'];
            $user->city_id = $validatedData['city_id'];
            $user->subdistrict = $validatedData['subdistrict'];
            $user->postal_code = $validatedData['postal_code'];
            $user->save();

            return back()->with('status', __("Address successfuly updated"));
        }catch(Exception $e){
            return back()->withInput()->with('error', __("Address can't be updated"));
        }
    }
}
