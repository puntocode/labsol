<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['prefijo' => 'Exa',   'simbolo' => 'E',  'factor' => '10¹⁸',  'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Peta',  'simbolo' => 'P',  'factor' => '10¹⁵',  'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Tera',  'simbolo' => 'T',  'factor' => '10¹²',  'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Giga',  'simbolo' => 'G',  'factor' => '10⁹',   'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Mega',  'simbolo' => 'M',  'factor' => '10⁶',   'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Kilo',  'simbolo' => 'k',  'factor' => '10³',   'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Hecto', 'simbolo' => 'h',  'factor' => '10²',   'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Deca',  'simbolo' => 'da', 'factor' => '10¹',   'tipo' => 'MULTIPLOS'],
            ['prefijo' => '-',     'simbolo' => '-',  'factor' => '⁻',     'tipo' => 'MULTIPLOS'],
            ['prefijo' => 'Deci',  'simbolo' => 'd',  'factor' => '10⁻¹',  'tipo' => 'SUBMULTIPLOS'],
            ['prefijo' => 'Centi', 'simbolo' => 'c',  'factor' => '10⁻²',  'tipo' => 'SUBMULTIPLOS'],
            ['prefijo' => 'Mili',  'simbolo' => 'm',  'factor' => '10⁻³',  'tipo' => 'SUBMULTIPLOS'],
            ['prefijo' => 'Micro', 'simbolo' => 'μ',  'factor' => '10⁻⁶',  'tipo' => 'SUBMULTIPLOS'],
            ['prefijo' => 'Nano',  'simbolo' => 'n',  'factor' => '10⁻⁹',  'tipo' => 'SUBMULTIPLOS'],
            ['prefijo' => 'Pico',  'simbolo' => 'p',  'factor' => '10⁻¹²', 'tipo' => 'SUBMULTIPLOS'],
            ['prefijo' => 'Femto', 'simbolo' => 'f',  'factor' => '10⁻¹⁵', 'tipo' => 'SUBMULTIPLOS'],
            ['prefijo' => 'Atto',  'simbolo' => 'a',  'factor' => '10⁻¹⁸', 'tipo' => 'SUBMULTIPLOS'],
        ];

        DB::table('unidad_medidas')->insert($data);
    }
}
