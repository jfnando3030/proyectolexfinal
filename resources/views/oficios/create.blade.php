@extends('layouts.administracion')
@section('contenido')
<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
    <h4 style="color: black; text-align:center; font-size:25px;">
        Generar Oficio
    </h4>
</div>
<div class="container-fluid">
    <div class="emp-profile" style="padding: 3%;">
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
                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                        <label>Tipo de oficio</label>
                                        {!! Form::select('inicioDia', $contratos, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>
                                </div>

                                {{-- <div class="row" id="oficio_ca" style="display:none">
                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Fecha:</label>
                                        <input class="form-control" required="required" name="fecha" type="date">
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;"></div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Provincia</label>
                                        {!! Form::select('inicioDia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Ciudad</label>
                                        {!! Form::select('inicioDia', $ciudades, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>

                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color: white;">
                                                <a class="nav-item nav-link active" id="nav-arrendador-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Arrendador</a>
                                                <a class="nav-item nav-link" id="nav-arrendatario-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Arrendatario</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-arrendador-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Número de Cédula:</label>
                                                        <input placeholder="Ingrese el número de cédula del arrendador" class="form-control" required="required" name="cedula" type="tel">
                                                    </div>

                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Nombre:</label>
                                                        <input placeholder="Ingrese el nombre completo del arrendador" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                                    </div>

                                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                                        <label>Dirección:</label>
                                                        <input placeholder="Ingrese la dirección del arrendador" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-arrendatario-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Número de Cédula:</label>
                                                        <input placeholder="Ingrese el número de cédula del arrendatario" class="form-control" required="required" name="cedula" type="tel">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Nombre:</label>
                                                        <input placeholder="Ingrese el nombre completo del arrendatario" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                                    </div>
                                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                                        <label>Dirección:</label>
                                                        <input placeholder="Ingrese la dirección del arrendatario" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>

                                <div class="row" id="oficio_psppacj" style="display:none">
                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Fecha:</label>
                                        <input class="form-control" required="required" name="fecha" type="date">
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;"></div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Provincia</label>
                                        {!! Form::select('inicioDia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Ciudad</label>
                                        {!! Form::select('inicioDia', $ciudades, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>

                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color: white;">
                                                <a class="nav-item nav-link active" id="nav-cliente-tab" data-toggle="tab" href="#nav-cliente" role="tab" aria-controls="nav-cliente" aria-selected="true">Cliente</a>
                                                <a class="nav-item nav-link" id="nav-abogado-tab" data-toggle="tab" href="#nav-abogado" role="tab" aria-controls="nav-abogado" aria-selected="false">Abogado</a>
                                                <a class="nav-item nav-link" id="nav-perito-tab" data-toggle="tab" href="#nav-perito" role="tab" aria-controls="nav-perito" aria-selected="false">Perito</a>
                                                <a class="nav-item nav-link" id="nav-vfpago-tab" data-toggle="tab" href="#nav-vfpago" role="tab" aria-controls="nav-vfpago" aria-selected="false">Valor y Forma de Pago</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-cliente" role="tabpanel" aria-labelledby="nav-cliente-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Número de Cédula:</label>
                                                        <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="cedula" type="tel">
                                                    </div>

                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Nombre:</label>
                                                        <input placeholder="Ingrese el nombre completo del cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Estado Civil</label>
                                                        {!! Form::select('inicioDia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                    </div>

                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Provincia</label>
                                                        {!! Form::select('inicioDia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                    </div>

                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Cantón:</label>
                                                        <input placeholder="Ingrese el nombre del cantón" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Correo Electrónico:</label>
                                                        <input placeholder="Ingrese el correo electrónico del cliente" class="form-control" required="required"  name="correo" type="email">
                                                    </div>
                                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                                        <label>Motivo:</label>
                                                        <input placeholder="Ingrese el motivo por el cuál el perito es contratado, especificando la experticia a realizar" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="nav-abogado" role="tabpanel" aria-labelledby="nav-abogado-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Número de Cédula:</label>
                                                        <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="cedula" type="tel">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Nombre:</label>
                                                        <input placeholder="Ingrese el nombre completo del abogado" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Calidad:</label>
                                                        <input placeholder="Ingrese la cualidad del abogado" class="form-control" required="required"  name="calidad" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Mat. Foro de Abogados:</label>
                                                        <input placeholder="Ingrese Mat. foro de abogados" class="form-control" required="required"  name="mat_foro_abogados" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="nav-perito" role="tabpanel" aria-labelledby="nav-perito-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Número de Cédula:</label>
                                                        <input placeholder="Ingrese el número de cédula del perito" class="form-control" required="required" name="cedula" type="tel">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Nombre:</label>
                                                        <input placeholder="Ingrese el nombre completo del perito" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Área:</label>
                                                        <input placeholder="Ingrese el nombre del área" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Calificación:</label>
                                                        <input placeholder="Ingrese el número de calificación" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="nav-vfpago" role="tabpanel" aria-labelledby="nav-vfpago-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Honorarios:</label>
                                                        <input placeholder="Ingrese el valor de los honorarios en letras" class="form-control" required="required" name="honorario_l" type="text">
                                                    </div><div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Honorarios:</label>
                                                        <input placeholder="Ingrese el valor de los honorarios en números" class="form-control" required="required" name="honorario_N" type="number">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Cuota de Entrada:</label>
                                                        <input placeholder="Ingrese el valor de la cuota de entrada" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Domicilio</label>
                                        <input placeholder="Ingrese el domicilio" class="form-control" required="required" onkeypress="return soloLetras(event)" name="domicilio" type="number">
                                    </div>
                                </div> --}}

                                {{-- <div class="row" id="oficio_psp" style="display:none">
                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Fecha:</label>
                                        <input class="form-control" required="required" name="fecha" type="date">
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;"></div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Provincia</label>
                                        {!! Form::select('inicioDia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Ciudad</label>
                                        {!! Form::select('inicioDia', $ciudades, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>

                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color: white;">
                                                <a class="nav-item nav-link active" id="nav-cliente-tab" data-toggle="tab" href="#nav-cliente" role="tab" aria-controls="nav-cliente" aria-selected="true">Cliente</a>
                                                <a class="nav-item nav-link" id="nav-abogado-tab" data-toggle="tab" href="#nav-abogado" role="tab" aria-controls="nav-abogado" aria-selected="false">Abogado</a>
                                                <a class="nav-item nav-link" id="nav-vfpago-tab" data-toggle="tab" href="#nav-vfpago" role="tab" aria-controls="nav-vfpago" aria-selected="false">Valor y Forma de Pago</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-cliente" role="tabpanel" aria-labelledby="nav-cliente-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Número de Cédula:</label>
                                                        <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="cedula" type="tel">
                                                    </div>

                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Nombre:</label>
                                                        <input placeholder="Ingrese el nombre completo del cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                                    </div>

                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Provincia</label>
                                                        {!! Form::select('inicioDia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                    </div>

                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Cantón:</label>
                                                        <input placeholder="Ingrese el nombre del cantón" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Correo Electrónico:</label>
                                                        <input placeholder="Ingrese el correo electrónico del cliente" class="form-control" required="required"  name="correo" type="email">
                                                    </div>
                                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                                        <label>Calidad:</label>
                                                        <input placeholder="Ingrese la cualidad del cliente" class="form-control" required="required"  name="calidad" type="text">
                                                    </div>
                                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                                        <label>Dirección:</label>
                                                        <input placeholder="Ingrese la dirección del cliente" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                                        <label>Motivo:</label>
                                                        <input placeholder="Ingrese el motivo por el cuál el abogado es contratado, especificando la experticia a realizar" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                    <div class="col-md-12" style="padding-bottom: 15px;">
                                                        <label>Causa:</label>
                                                        <input placeholder="Ingrese la causa por el cuál el abogado es contratado, especificando la experticia a realizar" class="form-control" required="required"  name="direccion" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="nav-abogado" role="tabpanel" aria-labelledby="nav-abogado-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Número de Cédula:</label>
                                                        <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="cedula" type="tel">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Nombre:</label>
                                                        <input placeholder="Ingrese el nombre completo del abogado" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Calidad:</label>
                                                        <input placeholder="Ingrese la cualidad del abogado" class="form-control" required="required"  name="calidad" type="text">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                                        <label>Mat. Foro de Abogados:</label>
                                                        <input placeholder="Ingrese Mat. foro de abogados" class="form-control" required="required"  name="mat_foro_abogados" type="text">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="nav-vfpago" role="tabpanel" aria-labelledby="nav-vfpago-tab">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Honorarios:</label>
                                                        <input placeholder="Ingrese el valor de los honorarios en letras" class="form-control" required="required" name="honorario_l" type="text">
                                                    </div><div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Honorarios:</label>
                                                        <input placeholder="Ingrese el valor de los honorarios en números" class="form-control" required="required" name="honorario_N" type="number">
                                                    </div>
                                                    <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                        <label>Cuota de Entrada:</label>
                                                        <input placeholder="Ingrese el valor de la cuota de entrada" class="form-control" required="required" onkeypress="return soloLetras(event)" name="nombre" type="number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>

                                    <div class="col-md-6" style="padding-bottom: 15px;">
                                        <label>Domicilio</label>
                                        <input placeholder="Ingrese el domicilio" class="form-control" required="required" onkeypress="return soloLetras(event)" name="domicilio" type="number">
                                    </div>
                                </div> --}}

                                <div class="row" id="oficio_pj">
                                <form method="POST" action="{{ url('administracion/oficio/procuracion_judicial') }}" accept-charset="UTF-8">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Número de Cédula:</label>
                                                <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="opj_cedula" type="tel">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Nombre:</label>
                                                <input placeholder="Ingrese el nombre completo del cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_nombre" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Edad:</label>
                                                <input placeholder="Ingrese la edad del cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_edad" type="number">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Ocupación:</label>
                                                <input placeholder="Ingrese la ocupación del cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_ocupacion" type="text">
                                            </div>
    
                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                <label>Dirección:</label>
                                                <input placeholder="Ingrese la dirección domiciliaria del cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_direccion" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Estado Civil:</label>
                                                {!! Form::select('opj_estadocivil', $estado_civil, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Provincia</label>
                                                {!! Form::select('opj_provincia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Cantón:</label>
                                                <input placeholder="Ingrese el cantón donde reside el cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_canton" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Teléfono:</label>
                                                <input placeholder="Ingrese el número de teléfono del cliente" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_telefono" type="tel">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Procedimiento:</label>
                                                <input placeholder="Ingrese el nombre del procedimiento" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_procedimiento" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Causa:</label>
                                                <input placeholder="Ingrese el número de la causa en letras" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_causa_l" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Causa:</label>
                                                <input placeholder="Ingrese el número de la causa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_causa_n" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Nombre de Unidad Judicial o Institución:</label>
                                                <input placeholder="Ingrese el número de la causa" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_uji" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Cantón:</label>
                                                <input placeholder="Ingrese el cantón donde está ubicada la institución" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_cantonuji" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Provincia</label>
                                                {!! Form::select('opj_provinciauji', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Nombre del Juez o Funcionario Público:</label>
                                                <input placeholder="Ingrese el nombre del Juez o Funcionario público" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_juez_funcionario" type="text">
                                            </div>
    
                                            <div class="col-md-6" style="padding-bottom: 15px;"></div>
    
                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                            <div class="col-md-4" style="padding-bottom: 15px;">
                                                <input class="btn btn-primary btn-block" type="submit" value="Generar Oficio">
                                            </div>
                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        /* $( "[name='opj_provincia']" ).change(function() {
        alert( "Handler for .change() called." + this.value.text);
        }); */
    </script>

@endsection