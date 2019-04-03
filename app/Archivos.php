<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
     protected $table ='archivos';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'path',
        'estado',
        'id_solicitud',
    ];
}