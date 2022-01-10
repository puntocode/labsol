<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class EgresoInstrumentoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entregado_por'  => 'required|int|exists:users,id',
            'recibido_por'   => 'required|string',
            'identificacion' => 'required|int',
            'observaciones'  => 'nullable|string',
            'expedientes'    => 'required|array',
            'expedientes.*'  => 'int|exists:expedientes,id,egresado,0',
        ];
    }
}
