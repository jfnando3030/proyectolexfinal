<?php

namespace App\Http\Controllers;

use App\Tarifa;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
use App\Log;
use Illuminate\Support\Facades\Auth;

class TarifaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tarifas = Tarifa::where('estado',1)->orderBy('id')->paginate(5);
        // dd($tarifas[0]->tarifa);
        return view('tarifa.index')->with( 'tarifas' , $tarifas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tarifa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $tarifaCreada = Tarifa::create([
            'tarifa'=>$request->tarifa,
            'precio'=>$request->precio,
            'descripcion'=>$request->descripcion
        ]);

        if($tarifaCreada->tarifa != null){ 
            return redirect('administracion/tarifa')->with('mensaje-registro', 'Datos registrados correctamente.');
        }
        else{
            $request->flash();
            return redirect('administracion/tarifa/create')->with('mensaje-error', 'Error al registrar los datos.');
        }
    } 

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $_id= Crypt::decrypt($id);
        $tarifa = Tarifa::find($_id);
        return $tarifa;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tarifa = $this->show($id);
        return view('tarifa.edit')->with('tarifa', $tarifa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $tarifa = $this->show($id);
        $tarifa->fill($request->all());

        if($tarifa->save()){ 

            $date = Carbon::now();
    $hoy = $date->format('Y-m-d');
    $hora = $date->format('H:i:s');

    $ip_navegador= $request['ip_valor']. ' - ' .$request['navegador'];

    Log::create([
        'fecha_log' => $hoy,
        'hora_log' => $hora,
        'estado' => 1,
        'id_user_log' => Auth::user()->id,
        'ip' =>  $ip_navegador,
        'accion' => "Modifico una tarifa",
                    

    
    ]);
            return redirect('administracion/tarifa')->with('mensaje-registro', 'Datos actualizados correctamente.');
        }
        else{
            $request->flash();
            return redirect('administracion/tarifa/'. Crypt::encrypt($tarifa->id).'/edit')->with('mensaje-error', 'Error al actualizar datos.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tarifa= $this->show($id);
        $tarifa->delete();
        return Redirect::to('administracion/tarifa');
    }
}
