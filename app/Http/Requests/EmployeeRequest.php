<?php

namespace preventaBiox\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'nombres_empleado'  => 'required',
            'apellidos_empleado'=> 'required',
            'telefono_empleado' => 'required',
            'correo_empleado'   => 'required',
            'password_empleado' => 'required'
        ];
    }
}