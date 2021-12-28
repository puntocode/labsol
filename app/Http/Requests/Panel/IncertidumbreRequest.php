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
        $rules = [
            'contribucion'    => 'required|string|in:EBC,PATRON',
            'tipo'            => 'required|string|in:A,B',
            'nombre'          => 'required|string',
            'distribucion'    => 'required|string',
            'fuente'          => 'required|string',
            'divisor'         => 'required|string',
            'coeficiente'     => 'required|integer',
            'contribucion_du' => 'required|integer',
            'formula_img'     => 'image|max:512|mimes:jpeg,jpg',
            'formula'         => [
                'required',
                'string',
                Rule::unique('incertidumbres')->ignore($this->incertidumbre)
            ],
        ];

        if ($this->isMethod('POST')) {
            $rules['formula_img'] = 'required|' . $rules['formula_img'];
        }

        return $rules;
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        $validatedData = parent::validated();

        $validatedData['grados_libertad_for'] = $this->get('tipo') == 'A' ? 'n-1' : '∞';

        return $validatedData;
    }
}
