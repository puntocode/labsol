<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(AlertCalibrationSeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(StatusCalibrationSeeder::class);
        $this->call(MagnitudeSeeder::class);
        $this->call(FormularioSeeder::class);
        $this->call(PatronSeeder::class);
        $this->call(EquipoSeeder::class);
        $this->call(InstrumentoSeeder::class);
        $this->call(UnidadMedidaSeeder::class);
        $this->call(ExpedienteEstadoSeed::class);
        $this->call(EquipoAmbientalSeeder::class);
        $this->call(ProcedimientoSeeder::class);
        $this->call(InstrumentoProcedimientoSeed::class);
    }
}
