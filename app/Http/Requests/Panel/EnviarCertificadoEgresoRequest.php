<?php

namespace App\Http\Requests\Panel;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EnviarCertificadoEgresoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expedientes'    => 'required|array',
            'expedientes.*'  => [
                'int',
                Rule::exists('expedientes', 'id')
                    ->where('enviado', false)
                    ->whereIn('expediente_estado_id', [5, 10]),
            ]
        ];
    }
}
