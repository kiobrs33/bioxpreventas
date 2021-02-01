<?php

namespace preventaBiox\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BonuseRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'titulo_bono'       => 'required',
            'descripcion_bono'  => 'required',
            'cantidad_bono'     => 'required',
            'productsId_bono'   => 'required'
        ];
    }
}