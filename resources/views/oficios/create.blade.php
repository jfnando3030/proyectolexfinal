@extends('layouts.administracion')
@section('contenido')
<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
    <h4 style="color: black; text-align:center; font-size:25px;">
        Generar Oficio
    </h4>
</div>
<div class="container-fluid">
    <div class="emp-profile" style="padding: 3%;">
        <form method="POST" action="{{route('oficio.store')}}" accept-charset="UTF-8">
            @csrf
            <div id="msj-success" class="alert alert-success alert-dismissible aprobado" role="alert" style="display:none">
                <strong> Credenciales Modificados Correctamente.</strong>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Fecha:</label>
                                            <input class="form-control" required="required" name="fecha" type="date">
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Provincias</label>
                                            {!! Form::select(
                                                'inicioDia',
                                                $provincia, 
                                                null,
                                                ['class'=>'form-control', 'required' => 'required']) 
                                            !!}
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Ciudad:</label>
                                            <input placeholder="Ingrese el nombre de la ciudad" class="form-control" required="required" onkeypress="return soloLetras(event)" name="ciudad" type="text">
                                        </div>
                                        <div class="col-md-12" style="padding-bottom: 15px;">
                                            <label>Asunto:</label>
                                            <input placeholder="Ingrese el asunto" class="form-control" required="required" onkeypress="return soloLetras(event)" name="asunto" type="text">
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Destinatario:</label>
                                            <input placeholder="Ingrese el nombre del destinatario" class="form-control" required="required" onkeypress="return soloLetras(event)" name="destinatario" type="text">
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Cargo:</label>
                                            <input placeholder="Ingrese el nombre del cargo" class="form-control" required="required" onkeypress="return soloLetras(event)" name="cargo" type="text">
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Solicitante:</label>
                                            <input placeholder="Ingrese el nombre del solicitante" class="form-control" required="required" onkeypress="return soloLetras(event)" name="solicitante" type="text">
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Número de Cédula:</label>
                                            <input placeholder="Ingrese el número de cédula del solicitante" class="form-control" required="required" name="cedula" type="tel">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4" style="padding-bottom: 15px;">
                            <input class="btn btn-primary btn-block" type="submit" value="Generar Oficio">
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection