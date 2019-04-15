<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class OficioController extends Controller
{
    public $datos;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /* return view('oficios.index'); */
        // $valor = session()->driver();
        /* $pdf = PDF::loadView('oficios.index', $datos);
        return $pdf->stream(); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('oficios.create');
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
        $datos = [
            "fecha" => $request->fecha,
            "ciudad" => $request->ciudad,
            "asunto" => $request->asunto,
            "destinatario" => $request->destinatario,
            "cargo" => $request->cargo,
            "solicitante" => $request->solicitante,
            "cedula" => $request->cedula
        ];
        $pdf = PDF::loadView('oficios.pdf', $datos);
        return $pdf->stream();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
