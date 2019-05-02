<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    //Tabla visitas
    protected $table='visitas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_user',
        'fecha'
    ];
}
