<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileAccessController extends Controller
{
    public function serve($file)
    {
        if(Auth::check()) {
            // Here we don't use the Storage facade that assumes the storage/app folder
            // So filename should be a relative path inside storage to your file like 'app/userfiles/report1253.pdf'
            $filepath = storage_path('app/payment_proffs/'.$file);
            return response()->file($filepath);
        }else{
            return abort('404');
        }
    }
}
