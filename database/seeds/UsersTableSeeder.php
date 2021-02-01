<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id =  DB::table('users')->insertGetId([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('bioxperu')
        ]);

        DB::table('employees')->insert([
            'nombres'   => 'admin',
            'apellidos' => 'admin',
            'telefono'  => '123456',
            'correo'    => 'admin@gmail.com',
            'slug'      => 'admin123',
            'users_id'  => $id
        ]);
    }
}