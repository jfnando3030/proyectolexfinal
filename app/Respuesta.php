<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $table ='respuestas';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'titulo',
        'respuesta',
        'estado',
        'solicitud_id',
        'id_user_receptor',
        'leido',
        'fecha',
        'hora',
        'id_autorespuesta',
        'tiene_archivo_adjunto',
    ];

    public function solicitud(){
        return $this->belongsTo(Solicitud::class,'solicitud_id','id');
    }

 
}
