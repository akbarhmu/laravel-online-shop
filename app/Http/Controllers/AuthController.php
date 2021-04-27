<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function index(){
        return view('auth.index');
    }

    public function create(){
        return view('auth.create');
    }

    public function store(LoginRequest $request){
        $validatedData = $request->validated();
        $errors = new MessageBag();

        if(Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']], (isset($validatedData['remember'])?'true':'false'))){
            $request->session()->regenerate();
            if(Auth::user()->roles=='admin'){
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('index');
            }
        } else {
            $errors = new MessageBag(['failed' => ['auth.failed']]);
            return redirect()->route('auth.index')->withErrors($errors)->withInput();
        }
    }

    public function register(RegisterRequest $request){
        $validatedData = $request->validated();
        $errors = new MessageBag();

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);

        if($user->save()){
            event(new Registered($user));
            return redirect()->route('auth.index')->with('status', __('Registration successfull'));
        } else {
            $errors = new MessageBag(['failed' => [__('Registration failed')]]);
            return redirect()->route('auth.create')->withErrors($errors)->withInput();
        }
    }

    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
