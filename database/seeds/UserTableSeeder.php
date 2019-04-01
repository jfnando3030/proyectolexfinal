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

            'nombres'=>'Geovanny Manuel',
            'apellidos'=>'Mocha Geovanny',
            'cedula' => '2300331689',
            'codpatrocinador' => '2300331689',
            'rol' => "Administrador",
            'estado'=> 1,
            'email'=> 'gmocha14@gmail.com',
            'password'=> bcrypt('jovabsc123'),
            'direccion' => "",
            'idciudad' => 1,
            'idprovincia' => 1,
            'telefono' => "",
            'fechanacim' => "2019-03-14",
            'sexo' => "M",
            'activado' => "",
            'celular' => "",
            'emailrecupera' => "",
            'fechaactivacion' => "2019-03-14",
            'horaactivacion' => "20:12:11",
            'tipopagos' => "",
            'titular' => "",
            'codigobco' => 1, 
            'numctatarjeta' => "",
            'codigoseguridad' => "",
            'fechavencimiento' => "2019-03-14",
           
 


        ]);


    
    }
}
