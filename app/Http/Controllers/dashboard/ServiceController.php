<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services   = Service::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.services.index', ['services'=>$services]);
    }

    public function show(Service $service)
    {
        return view('admin.services.show', ['service'=>$service]);
    }

    public function update(Service $service)
    {
        try{
            $service->status = 2;
            $service->save();

            return back()->with('status', 'Layanan servis selesai');
        }catch(Exception $e){
            return back()->with('error', 'Terjadi kesalahan');
        }
    }
}
