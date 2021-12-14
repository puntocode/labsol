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
        User::create([
            'name' => 'Admin',
            'last_name' => 'Porta',
            'email' => 'admin@mail.com',
            'uuid' => '',
            'phone' => '0981123456',
            'password' => bcrypt('1234')
        ])->assignRole('gerencia_tecnica');

        User::create([
            'name' => 'Robert',
            'last_name' => 'Duarte',
            'email' => 'robert.duarte@labsol.com.py',
            'uuid' => 'ID2012LS001',
            'phone' => '0981215548',
            'password' => bcrypt('1234')
        ])->assignRole('gerencia_tecnica');


        User::create([
            'name' => 'José',
            'last_name' => 'Fernández',
            'email' => 'jose.fernandez@labsol.com.py',
            'uuid' => 'ID2016LS004',
            'phone' => '0981862094',
            'password' => bcrypt('1234')
        ])->assignRole('jefatura_calidad');

        User::create([
            'name' => 'Victor',
            'last_name' => 'Vargas',
            'email' => 'victor.vargas@labsol.com.py',
            'uuid' => 'ID2020LS022',
            'phone' => '0961170058',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Alexander',
            'last_name' => 'Vera',
            'email' => 'alexander.vera@labsol.com.py',
            'uuid' => 'ID2020LS018',
            'phone' => '0983857648',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Emilio',
            'last_name' => 'Gimenez',
            'email' => 'emilio.gimenez@labsol.com.py',
            'uuid' => 'ID2020LS024',
            'phone' => '0961905500',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Andrea',
            'last_name' => 'Fernández',
            'email' => 'andrea.fernandez@labsol.com.py',
            'uuid' => 'ID2017LS008',
            'phone' => '0991229455',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Juan',
            'last_name' => 'Espínola',
            'email' => 'juan.espinola@labsol.com.py',
            'uuid' => 'ID2020LS020',
            'phone' => '0992829375',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Axel',
            'last_name' => 'Vera',
            'email' => 'axel.vera@labsol.com.py',
            'uuid' => 'ID2021LS025',
            'phone' => '0984546522',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Jhonatan',
            'last_name' => 'Cho',
            'email' => 'jefe.calibraciones@labsol.com.py',
            'uuid' => 'ID2020LS023',
            'phone' => '0994316284',
            'password' => bcrypt('1234')
        ])->assignRole('jefatura_administrativa');

        User::create([
            'name' => 'Giuliano',
            'last_name' => 'Nunez',
            'email' => 'calibraciones@labsol.com.py',
            'uuid' => 'ID2020LS019',
            'phone' => '0991710630',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Ronald',
            'last_name' => 'Alborno',
            'email' => 'jefe.ensayos@labsol.com.py',
            'uuid' => 'ID2018LS013',
            'phone' => '0985377915',
            'password' => bcrypt('1234')
        ])->assignRole('personal_laboratorio');

        User::create([
            'name' => 'Melina',
            'last_name' => 'Alvarenga',
            'email' => 'administracion@labsol.com.py',
            'uuid' => 'ID2018LS013',
            'phone' => '0991753714',
            'password' => bcrypt('1234')
        ])->assignRole('secretaria_administrativa');

    }
}
