<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\Expediente;

class ExpedienteObserver
{
    /**
     * Handle the Expediente "created" event.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return void
     */
    public function created(Expediente $expediente)
    {
        //$prioridad = $expediente->servicios->priority;
        //if($prioridad === 'URGENTE') $expediente->delivery_date =  Carbon::tomorrow();
        $expediente->number = $expediente->type.'-'.($expediente->id+1000);
        $expediente->save();
    }

    /**
     * Handle the Expediente "updated" event.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return void
     */
    public function updated(Expediente $expediente)
    {
        //
    }

    /**
     * Handle the Expediente "deleted" event.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return void
     */
    public function deleted(Expediente $expediente)
    {
        //
    }

    /**
     * Handle the Expediente "restored" event.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return void
     */
    public function restored(Expediente $expediente)
    {
        //
    }

    /**
     * Handle the Expediente "force deleted" event.
     *
     * @param  \App\Models\Expediente  $expediente
     * @return void
     */
    public function forceDeleted(Expediente $expediente)
    {
        //
    }
}
