<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table ='solicitud';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'nombre_solicitud',
        'descripcion',
        'id_departamento',
        'finalizado_solicitud',
        'id_user_solicitud',
        'leido_solicitud',
        'id_user_abogado',
        'estado_solicitud',
        'fecha_solicitud',
        'hora_solicitud',
        'fecha_finalizacion_solicitud',
        'hora_finalizacion_solicitud',
        'fecha_aceptar_solicitud',
        'hora_aceptar_solicitud',
        'tiene_archivo_adjunto',
    ];

    public function usuario(){
        return $this->belongsTo(User::class,'id_user_solicitud','id');
    }

    public function abogado(){
        return $this->belongsTo(User::class,'id_user_abogado','id');
    }


    public function departamento(){
        return $this->belongsTo(Departamento::class,'id_departamento','id');
    }

}