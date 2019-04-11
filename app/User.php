<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\NotifyLawyers as sendLawyerNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;



class User extends Authenticatable  implements MustVerifyEmailContract
{
    use Notifiable;
    use MustVerifyEmail;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres', 'apellidos', 'email', 'password', 'cedula', 'estado', 'rol', 'path', 'telefono', 'celular', 'direccion', 'created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPathAttribute($path)
    {
        if (!empty($path)) {
            if ($path =="eliminar") {
                if (!empty($this->attributes['path'])) {
                    \Storage::delete($this->attributes['path']);
                }
                $this->attributes['path']=null;
            }
            else {
                /* Para Actualizar Imagen */
                if ( ! empty($this->attributes['path'])) {
                    \Storage::delete($this->attributes['path']);
                }
                $this->attributes['path'] = $path->getClientOriginalName();
                $name = $path->getClientOriginalName();
                \Storage::disk('local')->put($name, \File::get($path));
            }
        }

    }

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendLawyersNotifications($nombreDepartamento, $idSolicitud)
    {
        $this->notify(new sendLawyerNotification($nombreDepartamento, $idSolicitud));
    }

    public function departamentos(){
        return $this->belongsToMany(Departamento::class);
   }

    
}
