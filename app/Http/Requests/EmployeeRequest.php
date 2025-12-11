<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules =  [
            'name_ar'                  => 'required|string|max:255',
            'name_en'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $this->route('id'),
            'password'              => 'required|string|min:6',
            'employee_number'       => 'nullable|string|max:6|min:4|unique:users,employee_number,' . $this->id,

            'address_ar'            => 'required|string|max:500',
            'address_en'            => 'required|string|max:500',

            'phone'                 => 'required|string|max:20',
            'age'                   => 'required|integer|min:18|max:100',
            'gender'                => 'required|in:male,female',

            'job_title_ar'          => 'required|string|max:255',
            'job_title_en'          => 'required|string|max:255',

            'birthdate'             => 'required|date',

            'department_id'         => 'nullable|exists:departments,id',
            'work_schedule_id'      => 'nullable|exists:work_schedules,id',

            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'nullable|string|min:6';
            $rules['email'] = 'required|string|email';
        } else {
            $rules['password'] = 'required|string|min:6';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name_ar.required'             => __('words.name_required'),
            'name_en.required'             => __('words.name_en_required'),
            'email.required'            => __('words.email_required'),
            'email.email'               => __('words.email_valid'),
            'email.unique'              => __('words.email_unique'),
            'password.required'         => __('words.password_required'),
            'password.min'              => __('words.password_min'),
            'password.confirmed'        => __('words.password_confirmed'),
            'employee_number.unique'    => __('words.employee_number_unique'),
            'address_ar.required'       => __('words.address_required'),
            'address_en.required'       => __('words.address_required'),
            'phone.required'            => __('words.phone_required'),
            'age.required'              => __('words.age_required'),
            'age.integer'               => __('words.age_integer'),
            'gender.required'           => __('words.gender_required'),
            'gender.in'                 => __('words.gender_in'),
            'job_title_ar.required'     => __('words.job_title_required'),
            'job_title_en.required'     => __('words.job_title_required'),
            'birthdate.required'        => __('words.birthdate_required'),
            'birthdate.date'            => __('words.birthdate_date'),
            'department_id.exists'      => __('words.department_exists'),
            'work_schedule_id.exists'   => __('words.work_schedule_exists'),
            'image.image'               => __('words.image_image'),
            'image.mimes'               => __('words.image_mimes'),
            'image.max'                 => __('words.image_max'),
        ];
    }
}
