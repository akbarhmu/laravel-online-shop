<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|alpha',
            'email' => 'required|email:filter|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'terms' => 'accepted',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Name'),
            'email' => __('Email address'),
            'password' => __('Password'),
            'password_confirmation' => __('Password Confirmation'),
            'terms' => __('Terms of Service')
        ];
    }
}
