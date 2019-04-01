<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Herramienta;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\HerramientaRequest;
use Illuminate\Support\Facades\Crypt;
class HerramientasController extends Controller
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

        $herramientas = Herramienta::where('estado',1)->orderBy('id')->paginate(2);
  
        if ($request->ajax()) {
            return view('herramientas-ajax', compact('herramientas'));
        }
  
        return view('administracion.herramientas.index',compact('herramientas'));


      
      
   

      

            
       

        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    

        
        return View('administracion.herramientas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HerramientaRequest $request)
    {

      
        Herramienta::create($request->all());

        return Redirect::to('administracion/herramientas/create')->with('mensaje-registro', 'Registrado Correctamente');
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
        $herramienta = Herramienta::find($nuevo_id);
     
     
        
       
        return view('administracion.herramientas.edit',compact('herramienta'));

    }

    
    public function update(HerramientaRequest $request, $id)
    {

        $herramienta = Herramienta::find($id);
        $herramienta->fill($request->all());


     
        if($herramienta->save()){
            return Redirect::to('administracion/herramientas')->with('mensaje-registro', 'Actualizado Correctamente');
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
        $herramienta = Herramienta::find($id);
        $comentherramientaario->estado = 0;
        $herramienta->save();

        $message = "Eliminado Correctamente";
        if ($request->ajax()) {
            return response()->json([
                'id'      => $herramienta->id,
                'message' => $message
            ]);
        }
    }


}
