<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table ='departamento';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'nombre_departamento',
        'descripcion_departamento',
        'estado_departamento',
    ];

    public function usuarios(){
        return $this->belongsToMany(User::class);
    }
}
