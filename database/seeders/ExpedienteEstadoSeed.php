<?php

namespace Database\Seeders;

use App\Models\ExpedienteEstado;
use Illuminate\Database\Seeder;

class ExpedienteEstadoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpedienteEstado::create(['name' => 'EN ESPERA'    , 'color' => 'warning', 'icon' => 'fa-clock']);
        ExpedienteEstado::create(['name' => 'EN PROCESO'   , 'color' => 'primary', 'icon' => 'fa-tools']);
        ExpedienteEstado::create(['name' => 'COMPLETADA'   , 'color' => 'success', 'icon' => 'fa-calendar-check']);
        ExpedienteEstado::create(['name' => 'APROBADA'     , 'color' => 'info'   , 'icon' => 'fa-certificate']);
        ExpedienteEstado::create(['name' => 'FACTURADA'    , 'color' => 'success', 'icon' => 'fa-receipt']);
        ExpedienteEstado::create(['name' => 'ANULADA'      , 'color' => 'danger' , 'icon' => 'fa-times']);
        ExpedienteEstado::create(['name' => 'EN SUSPENSIÓN', 'color' => 'warning', 'icon' => 'fa-pause']);
        ExpedienteEstado::create(['name' => 'EN REVISIÓN'  , 'color' => 'info'   , 'icon' => 'fa-clipboard-list']);
        ExpedienteEstado::create(['name' => 'RECHAZADA'    , 'color' => 'danger' , 'icon' => 'fa-redo']);
        ExpedienteEstado::create(['name' => 'PREFACTURADO' , 'color' => 'primary', 'icon' => 'fa-clipboard-check']);

    }

}
