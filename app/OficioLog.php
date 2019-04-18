<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OficioLog extends Model
{


    	//Tabla pagos
        protected $table='oficios_log';
        protected $primaryKey = 'id';
        public $timestamps = false;
    
        protected $fillable = [
            'id', 
            'titulo_documento',
            'fecha',
            'usuario',
            'vista',
        ];

}
