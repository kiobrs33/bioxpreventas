<?php

namespace preventaBiox\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'id_empleado_pedido'        => 'required',
            'id_cliente_pedido'         => 'required',
            'comprobante_pedido'        => 'required',
            'descripcion_pedido'        => 'required',
            'direccion_pedido'          => 'required',
            'fecha_entrega_pedido'      => 'required',
            'impuesto_pedido'           => 'required',
            'total_pedido'              => 'required',
            'id_producto_pedido'        => 'required',
            'cantidad_producto_pedido'  => 'required',
            'subtotal_producto_pedido'  => 'required'
        ];
    }
}