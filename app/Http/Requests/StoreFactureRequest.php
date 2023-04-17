<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class StoreFactureRequest extends FormRequest
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
        $max = Product::find(($this->request->all()['product_id'])??($this->query->all()['product_id']))->stock;
        return [
            'owner_user_id'=>'required|numeric',
            'amount'=>[
                'required',
                'numeric',
                'min:1',
                "max:{$max}"
            ],
        ];
    }

    public function messages()
    {
        return [
            'amount.min'=>'La cantidad no debe ser menor a 0',
            'amount.max'=>'No hay stocks suficientes para la compra',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->request->all()['type_id']==='1') {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors(),
                'status' => true
            ], 422));

        }else{
            return ['reject' => $validator->errors()];
        }
    }

}
