<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
	//Tabla pagos
    protected $table='pagos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id', 
        'id_user',
        'id_tarifa',
        'fecha_inicio',
        'fecha_finalizacion',
        'modo_pago',
        'monto_pago',
        'activo',
        'estado',
        'comprobante_pago',
        'path',
        'cantidad_visitas', 
        'cantidad_consultorias'
    ];
}