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
            'name'    => 'funcionando',
        ]);

        Magnitude::create([
            'name'    => 'Eléctrica',
        ]);

        Magnitude::create([
            'name'    => 'Masa',
        ]);

        Magnitude::create([
            'name'    => 'Temperatura',
        ]);

        Magnitude::create([
            'name'    => 'Presión',
        ]);

        Magnitude::create([
            'name'    => 'Iluminación',
        ]);

        Magnitude::create([
            'name'    => 'Tiempo',
        ]);

        Magnitude::create([
            'name'    => 'Dureza',
        ]);

        Magnitude::create([
            'name'    => 'Acústica',
        ]);

        Magnitude::create([
            'name'    => 'Velocidad',
        ]);

        Magnitude::create([
            'name'    => 'Fuerza',
        ]);

        Magnitude::create([
            'name'    => 'Patrón de ref. calibración',
        ]);
    }
}
