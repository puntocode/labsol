<?php

namespace App\Http\Requests\Panel;

use App\Models\Cliente;
use Illuminate\Foundation\Http\FormRequest;

class AlmacenarPrefacturaRequest extends FormRequest
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
            'expedientes.*'  => "int|distinct|in:{$this->getExpedientesValidos()}",
        ];
    }

    /**
     * Obtienes los expediente válidos para agregar a la prefactura
     *
     * @return string
     */
    protected function getExpedientesValidos()
    {
        return Cliente::query()
            ->findOrFail($this->cliente_id)
            ->expedientes()
            ->whereHas('estados', function ($query) {
                $query->where('name', 'APROBADA');
            })
            ->get()
            ->implode('id', ',');
    }
}
