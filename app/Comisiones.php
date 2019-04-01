<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comisiones extends Model
{
    
    protected $table ='tb_comisiones';
    protected $primaryKey='id_idioma';
    public $timestamps = false;
    protected $fillable=[
        'num_transaccion',
        'cedula',
        'monto',
        'fecha',
        'descripcion',
        'tipocompra',
        'numcomprobante',
        'estadopago',
    ];



}