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
        Magnitude::create([ 'name' => 'AUXILIAR',    'condition_type' => 'EQUIPO']);
        Magnitude::create([ 'name' => 'ACUSTICA',    'condition_type' => 'PATRON',]);
        Magnitude::create([ 'name' => 'DIMENSIONAL', 'condition_type' => 'TODOS']);
        Magnitude::create([ 'name' => 'DUREZA',      'condition_type' => 'TODOS' ]);
        Magnitude::create([ 'name' => 'ELECTRICA',   'condition_type' => 'TODOS']);
        Magnitude::create([ 'name' => 'FUERZA',      'condition_type' => 'TODOS']);
        Magnitude::create([ 'name' => 'LONGITUD',    'condition_type' => 'EQUIPO',]);
        Magnitude::create([ 'name' => 'ILUMINACION', 'condition_type' => 'PATRON',]);
        Magnitude::create([ 'name' => 'MASA',        'condition_type' => 'TODOS',]);
        Magnitude::create([ 'name' => 'OPACIDAD',    'condition_type' => 'EQUIPO',]);
        Magnitude::create([ 'name' => 'PATRON DE REF. CALIBRACION', 'condition_type' => 'PATRON']);
        Magnitude::create([ 'name' => 'pH',           'condition_type' => 'EQUIPO']);
        Magnitude::create([ 'name' => 'PRESION',      'condition_type' => 'PATRON']);
        Magnitude::create([ 'name' => 'TEMPERATURA',  'condition_type' => 'TODOS']);
        Magnitude::create([ 'name' => 'TEMPERATURA/HUMEDAD', 'condition_type' => 'EQUIPO']);
        Magnitude::create([ 'name' => 'TIEMPO',       'condition_type' => 'PATRON',]);
        Magnitude::create([ 'name' => 'VELOCIDAD',    'condition_type' => 'PATRON',]);
        Magnitude::create([ 'name' => 'LUZ',          'condition_type' => 'PATRON',]);
   }
}
