<?php

use Illuminate\Database\Seeder;
use App\Tarifa;

class TarifaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
        Tarifa::create([
            'id'=>'1',

            'tarifa'=>'Familiar',
            'precio'=>'20',
            'cantidad_consultorias' => '2',
            'asesoria' => '0',
            'cantidad_documentos' => '0',
            'estado'=> 1,
            
           
 


        ]);

        Tarifa::create([
            'id'=>'2',

            'tarifa'=>'Pymes',
            'precio'=>'50',
            'cantidad_consultorias' => '2',
            'asesoria' => '1',
            'cantidad_documentos' => '2',
            'estado'=> 1,
            
           
 


        ]);

        Tarifa::create([
            'id'=>'3',

            'tarifa'=>'Empresarial',
            'precio'=>'200',
            'cantidad_consultorias' => '10',
            'asesoria' => '1',
            'cantidad_documentos' => '10',
            'estado'=> 1,
            
           
 


        ]);
    }
}
