<?php

namespace App\Http\Requests\Panel;

use Illuminate\Validation\Rule;
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
            'expedientes.*'  => [
                'int',
                Rule::exists('expedientes')
                    ->where('type', 'LS')
                    ->where('egresado', false)
                    ->whereIn('expediente_estado_id', [3, 4, 6])
            ]
        ];
    }
}
