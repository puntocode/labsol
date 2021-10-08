<?php

namespace Database\Seeders;

use App\Models\Magnitude;
use Illuminate\Database\Seeder;

class MagnitudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Magnitude::create([
            'name' => 'AUXILIAR',
            'condition_type' => 'EQUIPO'
        ]);

        Magnitude::create([
            'name' => 'ACUSTICA',
            'condition_type' => 'PATRON',
            'unit_measurement' => ['dB']
        ]);

        Magnitude::create([
            'name' => 'DIMENSIONAL',
            'condition_type' => 'TODOS',
            'unit_measurement' => ['m', 'cm', 'km', 'mm', 'ft', 'in']
        ]);

        Magnitude::create([
            'name' => 'DUREZA',
            'condition_type' => 'TODOS'
        ]);

        Magnitude::create([
            'name' => 'ELECTRICA',
            'condition_type' => 'TODOS',
            'unit_measurement' => ['A', 'V', 'Ω', 'W', 'Hp', 'Hz']
        ]);

        Magnitude::create([
            'name' => 'FUERZA',
            'condition_type' => 'TODOS',
            'unit_measurement' => ['N', 'Dyn', 'N.m', 'lb.in', 'kg.cm', 'kg.m', 'ft.lb']
        ]);

        Magnitude::create([
            'name' => 'LONGITUD',
            'condition_type' => 'EQUIPO'
        ]);

        Magnitude::create([
            'name' => 'ILUMINACION',
            'condition_type' => 'PATRON',
            'unit_measurement' => ['lx', 'lm']
        ]);

        Magnitude::create([
            'name' => 'MASA',
            'condition_type' => 'TODOS',
            'unit_measurement' => ['kg', 'g', 'lb']
        ]);

        Magnitude::create([
            'name' => 'OPACIDAD',
            'condition_type' => 'EQUIPO'
        ]);

        Magnitude::create([
            'name' => 'PATRON DE REF. CALIBRACION',
            'condition_type' => 'PATRON',
            'unit_measurement' => ['Ph', 'uS/m']
        ]);

        Magnitude::create([
            'name' => 'pH',
            'condition_type' => 'EQUIPO'
        ]);

        Magnitude::create([
            'name' => 'PRESION',
            'condition_type' => 'PATRON',
            'unit_measurement' => ['Pa', 'Bar', 'mHg', 'mH2O', 'kg/cm²', 'PSI']
        ]);

        Magnitude::create([
            'name' => 'TEMPERATURA',
            'condition_type' => 'TODOS',
            'unit_measurement' => ['K', '°C', '°F', '%']
        ]);

        Magnitude::create([
            'name' => 'TEMPERATURA/HUMEDAD',
            'condition_type' => 'EQUIPO'
        ]);

        Magnitude::create([
            'name' => 'TIEMPO',
            'condition_type' => 'PATRON',
            'unit_measurement' => ['s', 'min', 'hs']
        ]);

        Magnitude::create([
            'name' => 'VELOCIDAD',
            'condition_type' => 'PATRON',
            'unit_measurement' => ['m/s', 'km/h', 'Hz', 'rpm']
        ]);

        Magnitude::create([
            'name' => 'LUZ',
            'condition_type' => 'PATRON',
        ]);
   }
}
