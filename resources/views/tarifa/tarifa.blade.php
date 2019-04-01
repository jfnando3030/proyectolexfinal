@extends('layouts.administracion')
@section('contenido')
<section class="top" id="main2">
    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;">
            Ingresar Tarifa
        </h4>
    </div>
    <div class="container-fluid">
        <div class="emp-profile" style="padding: 3%;">
            <form method="POST" action="http://localhost/proyectolexfinal/administracion/enviar_mail_invitacion" accept-charset="UTF-8"><input name="_token" type="hidden" value="0bjLdn0Uv1R5vN12w7bckqlGYEE1zRLlWKOM6jhR">
                @csrf
                <div id="msj-success" class="alert alert-success alert-dismissible aprobado" role="alert" style="display:none">
                    <strong> Credenciales Modificados Correctamente.</strong>
                </div>
                <input type="hidden" name="_token" value="0bjLdn0Uv1R5vN12w7bckqlGYEE1zRLlWKOM6jhR" id="token">
                <input type="hidden" name="ruta" id ="ruta" value="http://localhost/proyectolexfinal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Nombres de la tarifa:</label>
                                                <input placeholder="Ingrese el nombre de la tarifa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Precio de la tarifa:</label>
                                                <input placeholder="Ingrese el precio de la tarifa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="precio" type="number" step="0.01">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                <label>Descripción de la tarifa:</label>
                                                <textarea placeholder="Ingrese la descripción breve de la tarifa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="descripcion" rows="10" cols="50"></textarea>
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
                                <input class="btn btn-primary btn-block" type="submit" value="Registrar Tarifa">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection