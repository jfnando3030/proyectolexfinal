<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    //Tabla Tarifa
    protected $table='tarifas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'tarifa',
        'precio',
        'descripcion',
        'estado'
    ];
}
