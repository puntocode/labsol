<?php

namespace Database\Seeders;

use App\Models\EquipoAmbiental;
use Illuminate\Database\Seeder;

class EquipoAmbientalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EquipoAmbiental::create([
            'code' => ['PCT-01', 'PCT-07', 'PCT-15', 'PCT-16', 'PCT-35']
        ]);

    }
}
