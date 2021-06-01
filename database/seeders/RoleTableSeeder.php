<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
        	//Control total
            ['name' => 'administrador', 'description' => 'Gerencia Técnica'],

          // Especificos
            ['name' => 'jefatura_calibracion', 'description' => 'Jefatura de calibración'],

            ['name' => 'secretaria', 'description' => 'Secretaría administrativa'],

            ['name' => 'jefatura_calidad', 'description' => 'Jefatura de calidad'],

            ['name' => 'tecnico', 'description' => 'Técnico'],

        ]);
    }
}
