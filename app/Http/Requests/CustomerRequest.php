<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'pass_number' => 'string|min:8|max:30|nullable',
            'name1' => 'required|string|min:5|max:50',
            'name2' => 'string|min:5|max:50|nullable',
            'birth_date' => 'nullable|regex:/^(?:[0-9]{2})\.(?:[0-9]{2})\.(?:[0-9]{4})$/',
            'birth_city' => 'string|min:3|max:50|nullable',
            'plz' => 'nullable|regex:/^(?:[0-9]{5})$/',
            'city' => 'nullable|string|min:3|max:50',
            'street' => 'nullable|string|min:3|max:50',
            'phone' => 'string|min:6|max:20|nullable',
            'car_number' => 'string|min:5|max:15|nullable',
            'email' => 'email|nullable',
            'driving_license_no' => 'string|min:6|max:15|nullable',
            'driving_license_class' => [
                Rule::in(['B', 'BE', 'B96', 'Klasse 3']), 'nullable'
            ],
            'comment' => 'string|max:1000|nullable',
        ];
    }
}
