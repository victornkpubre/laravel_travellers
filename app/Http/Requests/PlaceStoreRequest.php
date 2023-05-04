<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
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
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'stars' => ['required', 'numeric', 'max:5'],
            'people' => ['required', 'numeric'],
            'image' => ['mimes:jpg,png,jpeg,gif,svg', 'image', 'max:2048'],
            'location_id' => ['required'],
        ];
    }
}
