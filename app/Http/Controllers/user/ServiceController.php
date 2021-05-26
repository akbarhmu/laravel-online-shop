<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        return view('user.service.index');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'                  => 'required|regex:/^[a-zA-Z0-9 .-]*$/u',
            'address'               => 'required|string',
            'phone'                 => 'required|numeric',
            'product_name'          => 'required|regex:/^[a-zA-Z0-9 .-]*$/u',
            'product_merk'          => 'string',
            'keluhan'               => 'required|string',
            'image'                 => 'required|file|image',
            'h-captcha-response'    => 'required|HCaptcha'
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        try{
            $filename = $request->image->hashName();

            $service                = new Service();
            $service->name          = $request->name;
            $service->address       = $request->address;
            $service->phone         = $request->phone;
            $service->product_name  = $request->product_name;
            $service->product_merk  = $request->product_merk;
            $service->keluhan       = $request->keluhan;
            $service->image         = $request->image->move('images/user/services/', $filename);
            $service->status        = 1;
            $service->save();

            return redirect()->route('services.show', $service->id);
        }catch(Exception $e){
            return back()->with('error', 'Terjadi kesalahan')->withInput();
        }
    }

    public function show(Service $service)
    {
        return view('user.service.show', ['service'=>$service]);
    }
}
