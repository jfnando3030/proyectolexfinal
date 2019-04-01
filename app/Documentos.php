<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table ='tb_documentos';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'titulo',
        'descripcion',
        'pdf',
        'fecha_post',
        'estado',
 
    ];
}
