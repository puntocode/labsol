<?php

namespace Database\Seeders;

use App\Models\Formulario;
use Illuminate\Database\Seeder;

class FormularioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Formulario::create([
            'codigo' => 'LS-FOR-041',
            'revision' => '05',
            'vigencia' => '2022-01-14'
        ]);

        Formulario::create([
            'codigo' => 'LS-FOR-024',
            'revision' => '05',
            'vigencia' => '2021-01-13'
        ]);

        Formulario::create([
            'codigo' => 'LS-FOR-047',
            'revision' => '02',
            'vigencia' => '2018-06-06'
        ]);
    }
}
