<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
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
            'name'=>'string|unique:promotions,name',
            'season'=>'numeric',
            'active'=>'string',
        ];
    }


    public function messages()
    {
        return [
            'name.string'=>'debe ser un nombre valido',
            'name.unique'=>'el nombre ya fue registrado',
            'season.numeric'=>'debe ser un numero',
            'active.boolean'=>'debe ser booleano'
        ];
    }
}
