<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_admin = Role::where('name', 'administrador')->first();

        $user = new User();
        $user->nombres = 'Administrador';
        $user->apellidos = 'Demo';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('1234');
        $user->activo = 1;
        $user->save();
        $user->roles()->attach($role_admin);


        $role_jefatura_calibracion = Role::where('name', 'jefatura_calibracion')->first();

        $user = new User();
        $user->nombres = 'Jefatura de calibración';
        $user->apellidos = 'Demo';
        $user->email = 'calibracion@mail.com';
        $user->password = bcrypt('1234');
        $user->activo = 1;
        $user->save();
        $user->roles()->attach($role_jefatura_calibracion);

        $role_secretaria = Role::where('name', 'secretaria')->first();

        $user = new User();
        $user->nombres = 'Secretaría administrativa';
        $user->apellidos = 'Demo';
        $user->email = 'secretaria@mail.com';
        $user->password = bcrypt('1234');
        $user->activo = 1;
        $user->save();
        $user->roles()->attach($role_secretaria);

 		$role_jefatura_calidad = Role::where('name', 'jefatura_calidad')->first();

        $user = new User();
        $user->nombres = 'Jefatura de Calidad';
        $user->apellidos = 'Demo';
        $user->email = 'calidad@mail.com';
        $user->password = bcrypt('1234');
        $user->activo = 1;
        $user->save();
        $user->roles()->attach($role_jefatura_calidad);

        $role_tecnico = Role::where('name', 'tecnico')->first();

        $user = new User();
        $user->nombres = 'Técnico';
        $user->apellidos = 'Demo';
        $user->email = 'tecnico@mail.com';
        $user->password = bcrypt('1234');
        $user->activo = 1;
        $user->save();
        $user->roles()->attach($role_tecnico);

    }
}
