<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitasRespuestas extends Model
{
      //Tabla VisitasRespuestas
    protected $table='visitas_respuestas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'asunto',
        'respuesta',
        'fecha',
        'hora',
        'id_visita'
    ];
}
