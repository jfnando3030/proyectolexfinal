<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

use App\Respuesta;
use App\User;
use App\Http\Requests\PerfilRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Mail;
use Illuminate\Support\Facades\Crypt;


class PerfilController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         
    
        $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
         
        $respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->take(3)->get();

      
          return view('administracion.perfil.index', compact('total_respuestas_notificacion', 'respuestas_notificacion'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerfilRequest $request)
    {
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nuevo_id= Crypt::decrypt($id);
        $usuario = User::find($nuevo_id);

        $total_respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->count();
         
        $respuestas_notificacion = Respuesta::where('leido',0)->where('estado',1)->where('id_user_receptor', Auth::user()->id)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->take(3)->get();

      
    
     


        return view('administracion.perfil.edit',compact('usuario', 'total_respuestas_notificacion', 'respuestas_notificacion'));

    }

    /**
     * Update the specified resource in storage.
     *  "Fill" significa literalmente "llenar". Cuando se utiliza el método fill() en un modelo, establece los atributos del modelo a los que le pasemos como argumento en un array. Un ejemplo y quedará claro:
    *   $user = new User();

    *   $user->fill([
    *   'username' => 'IsraelOrtuno',
    *   'email' => 'laraveles@mail.com'
    *   ]);
    *   Esto sería el equivalente a hacer:
    *   $user = new User();

    *   $user->username = 'IsraelOrtuno';
    *   $user->email = 'laraveles@mail.com';
    *   Puede usarse tanto en una instancia nueva de un modelo, como con una existente, simplemente establece atributos de forma masiva.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilRequest $request, $id)
    {

        $data = $request; 
        $password = $data['password'];
        $email = $data['email'];
        $path = $data['path'];
     
        $usuario = User::find($id);
        $this->validate($request, [
            'email'     => [ 'required', Rule::unique('users')->ignore($usuario->id), ],
        ]);
        
       
            
            if($password==null ){ // que no me sobreescriba el password  con un valor null
             
                 $usuario->fill([
                    'nombres' => $request['nombres'],
                    'apellidos' => $request['apellidos'],
                    'email' => $request['email'],
                    'cedula' => $request['cedula'],
                    'direccion' => $request['direccion'],
                    'telefono' => $request['telefono'],
                    'celular' => $request['celular'],
                    'sexo' => $request['sexo'],
                    'fechanacim' => $request['fechanacim'],
                    'tipopagos' => $request['tipopagos'],
                    'titular' => $request['titular'],
                    'numctatarjeta' => $request['numctatarjeta'],
                    
                    'path'=> $request['path'],
                


                   
                ]);

            }else{ 

                $usuario->fill([
                    'nombres' => $request['nombres'],
                    'apellidos' => $request['apellidos'],
                    'email' => $request['email'],
                    'cedula' => $request['cedula'],
                    'direccion' => $request['direccion'],
                    'telefono' => $request['telefono'],
                    'celular' => $request['celular'],
                    'sexo' => $request['sexo'],
                    'fechanacim' => $request['fechanacim'],
                    'password' => bcrypt($request['password']),
                    'path'=> $request['path'],
                    'tipopagos' => $request['tipopagos'],
                    'titular' => $request['titular'],
                    'numctatarjeta' => $request['numctatarjeta'],
                


                   
                ]);
                
                    
           
                
            }

 

      
     
        if($usuario->save()){
            
                return Redirect::to('administracion/perfil')->with('mensaje-registro', 'Perfil Actualizado Correctamente');

            
           
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
       
    }
}
