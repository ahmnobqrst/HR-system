<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'=>'required|string|unique:departments,name->ar'.$this->id,
            'name_en'=>'required|string|unique:departments,name->en'.$this->id,
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => __('words.name_ar_required'),
            'name_ar.unique' => __('words.name_ar_unique'),
            'name_en.required' => __('words.name_en_required'),
            'name_en.unique' => __('words.name_en_unique'),
            'description_ar.required' => __('words.description_ar_required'),
            'description_en.required' => __('words.description_en_required'),
        ];
    }
}
