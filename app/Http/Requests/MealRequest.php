<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'lang' => 'required|alpha|',
            'per_page' => 'sometimes|integer',
            'page' => 'sometimes|integer'
        ];
    }

    public function messages()
    {
        return [
            'lang.required' => 'Language parameter is required (EN,FR,DE)',
            ''
        ];
    }
}
