<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlCreateRequest extends FormRequest
{
    protected $redirectRoute = 'urls.create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|max:2000|url'
        ];
    }
}
