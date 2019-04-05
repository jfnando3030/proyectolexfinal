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
    ];

    public function usuario(){
        return $this->belongsTo(User::class,'id_user_solicitud','id');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class,'id_departamento','id');
    }

}