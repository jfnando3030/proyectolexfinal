<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Respuesta;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\Crypt;

class NotificacionUserController extends Controller
{
    public function notificacion($id){
        $nuevo_id= Crypt::decrypt($id);

  
        
        $notificacion = Respuesta::find($nuevo_id);
        $notificacion->leido = 1;
        $notificacion->save();

       


        return Redirect::route('ver_respuesta', [$nuevo_id]);
     
    }

    public function all_notificaciones(){
       

  
        $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
         
        $respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'asc')->take(3)->get();

        $respuestas = Respuesta::where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'asc')->get();
      

       


        return view('administracion.notificaciones.index',compact('respuestas_notificacion','total_respuestas_notificacion','respuestas'));
    }
}
