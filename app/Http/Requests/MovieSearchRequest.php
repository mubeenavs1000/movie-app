<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allows all users to make this request
    }

    public function rules()
    {
        return [
            'title' => 'required'
        ];
    }
}

