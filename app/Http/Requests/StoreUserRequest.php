<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'=>'required|string',
            'second_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|email:rfc,dns|unique:users,email',
            'password'=>'required|confirmed|alpha_num:utf-8',
            'credentials'=>'required|numeric|unique:users,credentials',
            'born_date'=>'required|date',
            'catalogo'=>'nullable|string',
            'description'=>'nullable|string',
            'users_vip'=>'nullable|boolean',
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
            'email.unique'=>'El correo ya esta registrado',
            'email.email'=>'El correo requiere un dominio',
            'email.required'=>'El correo es obligatorio',
            'password.alpha_num'=>'La contraseña debe ser de numeros y letras',
            'password.confirmed'=>'Las contraseñas no coinciden',
            'password.required'=>'La contraseña es obligatorio',
            'credentials.unique'=>'El documento ya esta registrado',
            'credentials.numeric'=>'El documento solo puede llevar numeros',
            'credentials.required'=>'El documento es obligatorio',
            'born_date.date'=>'El formato de la fecha no es valido',
            'born_date.required'=>'La fecha de nacimiento es obligatorio',
            'catalogo.string'=>'El catalogo no puede tener numeros ni simbolos',
            'description.string'=>'La descripcion no puede tener numeros ni simbolos',
            'users_vip.boolean'=>'El pase vip debe ser booleano',
        ];
    }
}
