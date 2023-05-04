<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmotionStoreRequest extends FormRequest
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
            'image' => ['mimes:jpg,png,jpeg,gif,svg', 'image', 'max:2048'],
            'festival_id' => ['numeric'],
            'activity_id' => ['numeric'],
            'place_id' => ['numeric'],
        ];
    }
}
