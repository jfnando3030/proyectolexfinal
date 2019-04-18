<?php

use Illuminate\Database\Seeder;
use App\User;

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

            'nombres'=>'Geovanny',
            'apellidos'=>'Mocha',
            'cedula' => '2300331689',
            'rol' => "Administrador",
            'estado'=> 1,
            'email'=> 'gmocha14@gmail.com',
            'password'=> bcrypt('12345678'),
            'direccion' => "",
            'telefono' => "",
            'celular' => "0991851033",
            'ciudad' => "Machala",
            'email_verified_at'=>"2019-04-01 12:31:15",
           
 


        ]);

        User::create([

            'nombres'=>'Fernando',
            'apellidos'=>'Castillo',
            'cedula' => '0706829116',
            'rol' => "Abogado",
            'estado'=> 1,
            'email'=> 'jimmyfernandocastillo@gmail.com',
            'password'=> bcrypt('12345678'),
            'direccion' => "",
            'telefono' => "",
            'celular' => "",
            'ciudad' => "Machala",
            'email_verified_at'=>"2019-04-01 12:31:15",
           
 


        ]);

        User::create([

            'nombres'=>'Cristhoper',
            'apellidos'=>'Tapia',
            'cedula' => '123456789',
            'rol' => "Registrado",
            'estado'=> 1,
            'email'=> 'tapia@gmail.com',
            'password'=> bcrypt('12345678'),
            'direccion' => "",
            'telefono' => "",
            'celular' => "",
            'ciudad' => "Machala",
            'email_verified_at'=>"2019-04-01 12:31:15",
           
 


        ]);


    
    }
}
