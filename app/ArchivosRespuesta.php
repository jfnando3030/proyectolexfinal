<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivosRespuesta extends Model
{
     protected $table ='archivos_respuestas';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'path',
        'estado',
        'id_respuesta',
    ];
}
