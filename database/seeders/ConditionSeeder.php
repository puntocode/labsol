<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([ 'name' => 'FUNCIONANDO',               'condition_type' => 'TODOS',]);
        Condition::create([ 'name' => 'FUERA DE USO',              'condition_type' => 'TODOS',]);
        Condition::create([ 'name' => 'EN PROCESO DE CALIBRACION', 'condition_type' => 'EQUIPO',]);
        Condition::create([ 'name' => 'EN',                        'condition_type' => 'PATRON',]);

    }
}
