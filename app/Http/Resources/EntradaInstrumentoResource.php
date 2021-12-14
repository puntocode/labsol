<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntradaInstrumentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'certificate' => $this->certificate,
            'certificate_ruc' => $this->certificate_ruc,
            'certificate_address' => $this->certificate_address,
            'cliente_id' => $this->cliente_id,
            'instrument' => $this->instrument,
            'quantity' => $this->quantity,
            'service' => $this->service,
            'obs' => $this->obs,
            'type' => $this->type,
            'priority' => $this->priority,
            'delivered' => $this->delivered,
            'identification' => $this->identification,
            'user_id' => $this->user_id
        ];
    }
}
