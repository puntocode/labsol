<?php

namespace App\Http\Requests\Panel;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class IncertidumbreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contribucion'        => 'required|string|in:EBC,PATRON',
            'tipo'                => 'required|string|in:A,B',
            'nombre'              => 'required|string',
            'distribucion'        => 'required|string',
            'fuente'              => 'required|string',
            'divisor'             => 'required|string',
            'grados_libertad_for' => 'required|string',
            'coeficiente'         => 'required|integer',
            'contribucion_du'     => 'required|integer',
            'formula'             => [
                'required',
                'string',
                Rule::unique('incertidumbres')->ignore($this->incertidumbre)
            ],
        ];
    }
}
