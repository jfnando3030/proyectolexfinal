<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Herramienta extends Model
{
    protected $table='mis_herramientas';
    protected $primaryKey = 'id';
    public $timestamps = false;
 

    protected $fillable = [
        'id', 'titulo','descripcion','path','estado'
    ];


    public function setPathAttribute($path){

        if(!empty($path)){
            if ($path =="eliminar"){
                if ( ! empty($this->attributes['path'])) {
                    \Storage::delete($this->attributes['path']);
                }
                $this->attributes['path']=null;
            }
            else {
                /* Para Actualizar Imagen */
                if ( ! empty($this->attributes['path'])) {
                    \Storage::delete($this->attributes['path']);
                }
                $this->attributes['path'] = Carbon::now()->second.$path->getClientOriginalName();
                $name = Carbon::now()->second.$path->getClientOriginalName();
                \Storage::disk('local')->put($name, \File::get($path));
            }
        }

    }
}
