<?php

namespace App\Http\Requests\Staff\Medias;

use Illuminate\Foundation\Http\FormRequest;

class CoverImageRequest extends FormRequest
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
            'cover' => 'required|image|mimes:jpeg,jpg,png|max:1024'
        ];
    }
}
