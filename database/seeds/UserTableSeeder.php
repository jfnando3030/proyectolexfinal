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
            'celular' => "",
            'email_verified_at'=>"2019-04-01 12:31:15",
           
 


        ]);


    
    }
}
