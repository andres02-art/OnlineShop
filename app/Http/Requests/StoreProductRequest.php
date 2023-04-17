<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'precio'=>'numeric',
            'catalogo'=>'required',
            'img'=>'required|image|size:2048',
            'name'=>'string|required',
            'prom'=>'string',
            'mark'=>'required|string',
            'company'=>'required|string',
            'category_id'=>'required|numeric',
        ];
    }


    public function messages()
    {
        return [
            'precio.numeric'=>'El precio debe ser un numero',
            'catalogo.required'=>'El catalogo es obligatorio',
            'img.required'=>'La imagen es obligatoria',
            'img.size'=>'La imagen es demasiado grande',
            'img.image'=>'La imagen no es valida',
            'name.string'=>'El nombre debe ser letras',
            'name.required'=>'El nombre es obligatorio',
            'mark.string'=>'La marca del producto es obligatoria',
            'mark.required'=>'La marca del producto debe ser en letras',
            'company.string'=>'La compañia debe ser en lentras',
            'company.required'=>'La compañia es obligatoria',
            'company.number'=>'La compañia debe ser en numeros',
            'category_id.required'=>'La categoria es obligatoria',
            'category_id.numeric'=>'La categoria es invalida',
        ];
    }
}
