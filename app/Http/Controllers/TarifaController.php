<?php

namespace App\Http\Controllers;

use App\Tarifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
        $tarifas = Tarifa::where('estado',1)->orderBy('id')->paginate(2);
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
            'tarifa'=>$request->nombre,
            'precio'=>$request->precio,
            'descripcion'=>$request->descripcion
        ]);

        if($tarifaCreada->tarifa != null){ return $this->index();}
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
    public function update(Request $request, Tarifa $tarifa)
    {
        //

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
        return $this->index();
    }
}