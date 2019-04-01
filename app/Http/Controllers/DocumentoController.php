<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentosRequest;
use App\Http\Requests\DocumentosEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Documentos;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;

class DocumentoController extends Controller
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
        $documentos = Documentos::where('estado',1)->orderBy('id')->paginate(5);

        
        if ($request->ajax()) {
            return view('documentos-ajax', compact('documentos'));
        }
  

        return View('administracion.documentos.index',compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
     
        return View('administracion.documentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentosRequest $request)
    {

        $file= Input::file('pdf');
        $aleatorio= str_random(6);
        $nombre= $aleatorio.'-'.$file->getClientOriginalName();
 
       
        


        Documentos::create([
            'titulo' => $request['titulo'],
            'descripcion' => $request['descripcion'],
            'pdf'=> $nombre,
            'fecha_post' => $request['fecha_post'],
           
           
        ]);

         $file->move('public/pdf', $nombre);

            
       

        
        return Redirect::to('administracion/documentos/create')->with('mensaje-registro', 'Registrado Correctamente');


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
        $documento = Documentos::find($nuevo_id);
       


        return view('administracion.documentos.edit',compact('documento'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentosEditRequest $request, $id)
    {
        
        $documento = Documentos::find($id);
        $valorPDF= $request['pdf'];

 
        
           if($valorPDF==null){
               $documento->fill([

                   

                    'titulo' => $request['titulo'],
                    'descripcion' => $request['descripcion'],
                    'pdf'=> $documento->pdf,
                    'fecha_post' => $request['fecha_post'],
                  
                   
                ]);

           }else{

               $file= Input::file('pdf');
                $aleatorio= str_random(6);
                $nombre= $aleatorio.'-'.$file->getClientOriginalName();
                  $documento->fill([

                  

                    'titulo' => $request['titulo'],
                    'descripcion' => $request['descripcion'],
                    'pdf'=> $nombre,
                    'fecha_post' => $request['fecha_post'],
                
                   
                ]);

                $file->move('public/pdf', $nombre);
           }

                 

     
        


        if($documento->save()){
             
            return Redirect::to('administracion/documentos')->with('mensaje-registro', 'Actualizado Correctamente');
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
        $noticia = Documentos::find($id);
        $noticia->estado = 0;
        $noticia->save();

        $message = "Eliminado Correctamente";
        if ($request->ajax()) {
            return response()->json([
                'id'      => $noticia->id,
                'message' => $message
            ]);
        }
    }
}
