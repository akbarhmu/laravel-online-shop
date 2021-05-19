<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Shop;
use Exception;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::all();
        $shop = Shop::find(1);
        return view('admin.shops.index', ['provinces'=>$provinces, 'shop'=>$shop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|regex:/^[a-zA-Z0-9 .-]*$/u',
            'phone'         => 'required|numeric',
            'address'       => 'required|string|max:255',
            'province_id'   => 'required|exists:provinces,id',
            'city_id'       => 'required|exists:cities,id',
            'subdistrict'   => 'required|string|max:255',
            'postal_code'   => 'required|string|max:255',
            'logo'          => 'file|image|dimensions:min_width=100,min_height=100,ratio=1/1|max:1024'
        ]);

        try{
            $shop = Shop::find(1);
            $shop->name = $validatedData['name'];
            $shop->phone = $validatedData['phone'];
            $shop->address = $validatedData['address'];
            $shop->province_id = $validatedData['province_id'];
            $shop->city_id = $validatedData['city_id'];
            $shop->subdistrict = $validatedData['subdistrict'];
            $shop->postal_code = $validatedData['postal_code'];

            if($request->hasFile('logo')){
                $validatedData['logo']->move('images/logo/', 'logo.png');
            }

            $shop->save();

            return back()->with('status', __('Data updated successfully'));
        }catch(Exception $e){
            return back()->with('error', __("Data can't be updated"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
