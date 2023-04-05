<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'=>'required|string',
            'second_name'=>'required|string',
            'last_name'=>'required|string',
            'born_date'=>'required|date',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'El nombre es obligatorio',
            'name.string'=>'El nombre no puede tener numeros ni simbolos',
            'second_name.string'=>'El segundo nombre no puede tener numeros ni simbolos',
            'second_name.required'=>'El segundo nombre es obligatorio',
            'last_name.string'=>'El apellido no puede tener numeros ni simbolos',
            'last_name.required'=>'El apellido es obligatorio',
        ];
    }
}
