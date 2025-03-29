<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddFavoriteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'movie_id' => 'required',
            'movie_title' => 'required',
            'poster_url' => 'nullable'
        ];
    }
}

