<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarPrefacturaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->prefactura->cerrada;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = array_merge($this->getDetailsRules(), [
            'observacion' => 'nullable|string',
            'guardar'     => 'nullable|boolean',
            'cerrada'     => 'nullable|boolean'
        ]);

        return $rules;
    }


    /**
     * Retorna las reglas de validación para los detalles de sectores y costos de la prefactura
     *
     * @return array
     */
    public function getDetailsRules()
    {
        $this->prefactura->load('prefacturaDetalles.expediente.instrumentos');


        $rules = [];

        foreach ($this->prefactura->prefacturaDetalles as $prefacturaDetalle) {
            $rules["sector-$prefacturaDetalle->id"] = 'nullable|string';
            $rules["costo-$prefacturaDetalle->id"]  = 'required|numeric|min:0';
        }

        return $rules;
    }

    /**
     * Retorna los valore de los detalles de la prefactura
     *
     * @return array
     */
    public function getDetailsValues()
    {
        $values = [];

        foreach ($this->prefactura->prefacturaDetalles as $prefacturaDetalle) {
            $values [$prefacturaDetalle->id] = [
                'id'     => $prefacturaDetalle->id,
                'sector' => $this->get("sector-$prefacturaDetalle->id", ''),
                'costo'  => $this->get("costo-$prefacturaDetalle->id", 0),
            ];
        }

        return $values;
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        $validatedData = parent::validated();

        $validatedData['prefacturaDetalles'] = $this->getDetailsValues();

        $validatedData['total'] = collect($validatedData['prefacturaDetalles'])->sum('costo');

        if ($this->get('cerrada')) {
            $validatedData['fecha_cierre'] = now();
        }

        return $validatedData;
    }
}
