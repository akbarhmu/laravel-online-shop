<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9 ]*$/u|unique:categories,name',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('category name'),
        ];
    }
}
