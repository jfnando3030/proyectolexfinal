@extends('layouts.administracion')
@section('contenido')
<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
    <h4 style="color: black; text-align:center; font-size:25px;">
        Editar Tarifa
    </h4>
</div>
<div class="container-fluid">
    <div class="emp-profile" style="padding: 3%;">
        <form method="POST" action="{{route('tarifa.update', Crypt::encrypt($tarifa->id))}}" accept-charset="UTF-8">
            @method('PUT')
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
                                            <label>Nombres de la tarifa:</label>
                                            <input placeholder="Ingrese el nombre de la tarifa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="tarifa" type="text" value="{{$tarifa->tarifa}}">
                                        </div>
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <label>Precio de la tarifa:</label>
                                            <input placeholder="Ingrese el precio de la tarifa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="precio" type="number" step="0.01" value="{{$tarifa->precio}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="padding-bottom: 15px;">
                                            <label>Descripción de la tarifa:</label>
                                            <textarea placeholder="Ingrese la descripción breve de la tarifa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="descripcion" rows="7" >{{$tarifa->descripcion}}</textarea>
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
                            <input class="btn btn-primary btn-block" type="submit" value="Actualizar Tarifa">
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