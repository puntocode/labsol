<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleGerenciaTecnica     = Role::create(['name' => 'gerencia_tecnica']);
        $roleJefaturaCalibracion = Role::create(['name' => 'jefatura_administrativa']);
        $roleSecretariaAdmin     = Role::create(['name' => 'secretaria_administrativa']);
        $rolePersonalLaboratorio = Role::create(['name' => 'personal_laboratorio']);
        $roleJefaturaCalidad     = Role::create(['name' => 'jefatura_calidad']);

        Permission::create(['name' => 'panel.admin'])->syncRoles([$roleGerenciaTecnica]);
        Permission::create(['name' => 'panel.database'])->syncRoles([$roleGerenciaTecnica, $roleJefaturaCalidad]);
        Permission::create(['name' => 'panel.datos_calibracion'])->syncRoles([$roleGerenciaTecnica, $roleJefaturaCalidad, $rolePersonalLaboratorio, $roleJefaturaCalidad]);
        Permission::create(['name' => 'panel.gestion_lsi'])->syncRoles([$roleGerenciaTecnica, $roleJefaturaCalidad, $rolePersonalLaboratorio, $roleJefaturaCalidad]);

    }
}
