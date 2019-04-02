<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDepartamento extends Model
{
    protected $table ='departamento_user';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'user_id',
        'departamento_id',

    ];
}
