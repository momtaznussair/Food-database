<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'diet_ratings.*' => 'exists:rates,id',
            'diet_ratings' => 'required|array|min:1',
            'toxin_ratings.*' => 'exists:rates,id',
            'toxin_ratings' => 'required|array|min:1',
            'diets.*' => 'exists:diets,id',
            'diets' => 'required|array|min:1',
            'toxins.*' => 'exists:toxins,id',
            'toxins' => 'required|array|min:1',
        ];
    }
}
