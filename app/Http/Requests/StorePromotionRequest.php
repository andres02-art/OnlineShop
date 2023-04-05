<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
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
            'date_begin'=>'date',
            'date_end'=>'date'
        ];
    }


    public function messages()
    {
        return [
            'name.string'=>'debe ser un nombre valido',
            'name.unique'=>'el nombre ya fue registrado',
            'season.numeric'=>'debe ser un numero',
            'date_end.date'=>'debe ser una fecha valida',
            'date_begin.date'=>'debe ser una fecha valida',
            'active.boolean'=>'debe ser booleano'
        ];
    }
}
