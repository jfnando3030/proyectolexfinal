<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;


use App\User;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioEditRequest;
use Illuminate\Validation\Rule;

class UserController extends Controller
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

        $usuarios = User::where('estado',1)->orderBy('id')->paginate(6);
  
        if ($request->ajax()) {
            return view('usuarios-ajax', compact('usuarios'));
        }
  
        return view('administracion.usuarios.index',compact('usuarios'));


  
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            

        
        return View('administracion.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        
        $usuario= User::create([
                    'nombres' => $request['nombres'],
                    'apellidos' => $request['apellidos'],
                    'cedula' => $request['cedula'],
                    'email' => $request['email'],
                    'celular' => $request['celular'],
                    'telefono' => $request['telefono'],
                    'direccion' => $request['direccion'],
                    'path'=> $request['path'],
                    'password' => bcrypt($request['password']),
                    'rol'=>$request['id_roles'],
                   

                
                ]);

                


       

        return Redirect::to('administracion/usuarios/create')->with('mensaje-registro', 'Usuario Registrado Correctamente');
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
      
        
       
        return view('administracion.usuarios.edit',compact('usuario'));

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
    public function update(UsuarioEditRequest $request, $id)
    {

        $data = $request; 
        $password = $data['password'];
        $usuario = User::find($id);
        $this->validate($request, [
                                
             'email'     => [ 'required', Rule::unique('users')->ignore($usuario->id), ],
           
       ]);


    if($password==null ){ // que no me sobreescriba el password  con un valor null
             
        $usuario->fill([

            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'cedula' => $request['cedula'],
            'email' => $request['email'],
            'celular' => $request['celular'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
            'path'=> $request['path'],
            'rol'=>$request['id_roles'],
            

          
       ]);

   }else{ 

    $usuario->fill([

            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'cedula' => $request['cedula'],
            'email' => $request['email'],
            'celular' => $request['celular'],
            'telefono' => $request['telefono'],
            'password' => $request['password'],
            'direccion' => $request['direccion'],
            'path'=> $request['path'],
            'rol'=>$request['id_roles'],
        
   


      
   ]);
       
  
       
   }


        
     
        if($usuario->save()){
            return Redirect::to('administracion/usuarios')->with('mensaje-registro', 'Usuario Actualizado Correctamente');
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
        $usuario = User::find($id);
        $usuario->estado = 0;
        $usuario->save();

        $message = "Eliminado Correctamente";
        if ($request->ajax()) {
            return response()->json([
                'id'      => $usuario->id,
                'message' => $message
            ]);
        }
    }
}
