<?php

namespace Database\Seeders;

use App\Models\StatusPattern;
use Illuminate\Database\Seeder;

class StatusPaternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPattern::create([
            'name'    => 'funcionando',
        ]);

        StatusPattern::create([
            'name'    => 'en recalibración',
        ]);

        StatusPattern::create([
            'name'    => 'fuera de uso',
        ]);

        StatusPattern::create([
            'name'    => 'Eliminado',
        ]);
    }
}
