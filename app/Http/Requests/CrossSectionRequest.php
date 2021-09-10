<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrossSectionRequest extends FormRequest
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
            'profile_id' => 'nullable|numeric',
            'name' => 'nullable|string',
            'position' => 'nullable|numeric',
            'v_scale' => 'nullable|numeric',
            'h_scale' => 'nullable|numeric',
            'bank_l' => 'nullable|numeric',
            'bank_r' => 'nullable|numeric',
            'reference_level' => 'required|numeric',
            'bottom' => 'nullable|numeric',
            'water_lvl' => 'nullable|numeric',
            'font_size' => 'nullable|numeric',
        ];
    }
}
