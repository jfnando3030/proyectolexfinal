<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $table ='log';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'accion',
        'ip',
        'id_user_log',
        'estado',
        'fecha_log',
        'hora_log',
 
    ];

    public function usuario(){
        return $this->belongsTo(User::class,'id_user_log','id');
    }
}
