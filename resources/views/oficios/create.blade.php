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
                                        {!! Form::select('tipo_oficio', $contratos, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                    </div>
                                </div>

                                <div class="row" id="oficio_ca" style="display:none">
                                    <form method="POST" action="{{ url('administracion/oficio/contrato_arrendamiento') }}" accept-charset="UTF-8">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Fecha:</label>
                                                <input class="form-control" required="required" name="oca_fecha" type="date">
                                            </div>
        
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Provincia</label>
                                                {!! Form::select('oca_pronvicia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
        
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Ciudad</label>
                                                {!! Form::select('oca_ciudad', $ciudades, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>

                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                    <label>Duración</label>
                                                    <input class="form-control" placeholder="Ingrese la duración del contrato" required="required" name="oca_duracion" type="number">
                                                </div>
        
                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color: white;">
                                                        <a class="nav-item nav-link active" id="nav-arrendador-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Arrendador</a>
                                                        <a class="nav-item nav-link" id="nav-arrendatario-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Arrendatario</a>
                                                        <a class="nav-item nav-link" id="nav-local-tab" data-toggle="tab" href="#nav-local" role="tab" aria-controls="nav-local" aria-selected="false">Local</a>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-arrendador-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Número de Cédula:</label>
                                                                <input placeholder="Ingrese el número de cédula del arrendador" class="form-control" required="required" name="ocaarrendador_cedula" type="tel">
                                                            </div>
        
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Nombre:</label>
                                                                <input placeholder="Ingrese el nombre completo del arrendador" class="form-control" required="required" onkeypress="return soloLetras(event)" name="ocaarrendador_nombre" type="text">
                                                            </div>
        
                                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                                <label>Dirección:</label>
                                                                <input placeholder="Ingrese la dirección del arrendador" class="form-control" required="required"  name="ocaarrendador_direccion" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-arrendatario-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Número de Cédula:</label>
                                                                <input placeholder="Ingrese el número de cédula del arrendatario" class="form-control" required="required" name="ocaarrendatario_cedula" type="tel">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Nombre:</label>
                                                                <input placeholder="Ingrese el nombre completo del arrendatario" class="form-control" required="required" onkeypress="return soloLetras(event)" name="ocaarrendatario_nombre" type="text">
                                                            </div>
                                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                                <label>Dirección:</label>
                                                                <input placeholder="Ingrese la dirección del arrendatario" class="form-control" required="required"  name="ocaarrendatario_direccion" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="nav-local" role="tabpanel" aria-labelledby="nav-local-tab">
                                                            <div class="row">
                                                                <div class="col-md-12" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Antecedentes:</label>
                                                                    <input placeholder="Ingrese el destino del inmueble" class="form-control" required="required" name="ocalocal_antecedentes" type="text">
                                                                </div>
                                                                <div class="col-md-12" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Destino:</label>
                                                                    <input placeholder="Ingrese el destino del inmueble" class="form-control" required="required" name="ocalocal_destino" type="text">
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Precio:</label>
                                                                    <input placeholder="Ingrese la cantidad del precio" class="form-control" required="required" name="ocalocal_precio_n" type="number">
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Precio:</label>
                                                                    <input placeholder="Ingrese la cantidad del precio en letras" class="form-control" required="required" name="ocalocal_precio_l" type="text">
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Periodo</label>
                                                                    {!! Form::select('ocalocal_periodo', $periodos, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Intervalo:</label>
                                                                    <input placeholder="Ingrese el intervalo" class="form-control" required="required" name="ocalocal_intervalo" type="number">
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Garantía:</label>
                                                                    <input placeholder="Ingrese la cantidad de la garantía" class="form-control" required="required" name="ocalocal_garantia_n" type="number">
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Garantía:</label>
                                                                    <input placeholder="Ingrese la cantidad de la garantía en letras" class="form-control" required="required" name="ocalocal_garantia_l" type="text">
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Provincia:</label>
                                                                    {!! Form::select('ocalocal_provincia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                                </div>
                                                                <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Ciudad:</label>
                                                                    {!! Form::select('ocalocal_ciudad', $ciudades, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                                </div>
                                                                <div class="col-md-12" style="padding-bottom: 15px; padding-top: 15px;">
                                                                    <label>Dirección:</label>
                                                                    <input placeholder="Ingrese la dirección del local" class="form-control" required="required" name="ocalocal_direccion" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>                                    
                                            </div>

                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                            <div class="col-md-4" style="padding-bottom: 15px;">
                                                <input class="btn btn-primary btn-block" type="submit" value="Generar Oficio">
                                            </div>
                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                        </div>
                                    </form>
                                </div>

                                <div class="row" id="oficio_psppacj" style="display:none">
                                    <form method="POST" action="{{ url('administracion/oficio/contrato_psppacj') }}" accept-charset="UTF-8">
                                        @csrf
                                        <div class="row ">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Fecha:</label>
                                                <input class="form-control" required="required" name="psppacj_fecha" type="date">
                                            </div>
        
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Provincia</label>
                                                {!! Form::select('psppacj_provincia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
        
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Ciudad</label>
                                                {!! Form::select('psppacj_ciudad', $ciudades, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Cantón:</label>
                                                <input class="form-control" required="required" name="psppacj_canton" type="text">
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
                                                                <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="psppacjcliente_cedula" type="tel">
                                                            </div>
        
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Nombre:</label>
                                                                <input placeholder="Ingrese el nombre completo del cliente" class="form-control" required="required" name="psppacjcliente_nombre" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Estado Civil</label>
                                                                {!! Form::select('psppacjcliente_estado_civil', $estado_civil, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                            </div>
        
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Provincia</label>
                                                                {!! Form::select('psppacjcliente_provincia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                            </div>
        
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Cantón:</label>
                                                                <input placeholder="Ingrese el nombre del cantón" class="form-control" required="required"  name="psppacjcliente_canton" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Correo Electrónico:</label>
                                                                <input placeholder="Ingrese el correo electrónico del cliente" class="form-control" required="required"  name="psppacjcliente_correo" type="email">
                                                            </div>
                                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                                <label>Motivo:</label>
                                                                <input placeholder="Ingrese el motivo por el cuál el perito es contratado, especificando la experticia a realizar" class="form-control" required="required"  name="psppacjcliente_motivo" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="tab-pane fade" id="nav-abogado" role="tabpanel" aria-labelledby="nav-abogado-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Número de Cédula:</label>
                                                                <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="psppacjabogado_cedula" type="tel">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Nombre:</label>
                                                                <input placeholder="Ingrese el nombre completo del abogado" class="form-control" required="required" name="psppacjabogado_nombre" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Calidad:</label>
                                                                <input placeholder="Ingrese la cualidad del abogado" class="form-control" required="required"  name="psppacjabogado_calidad" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Mat. Foro de Abogados:</label>
                                                                <input placeholder="Ingrese Mat. foro de abogados" class="form-control" required="required"  name="psppacjabogado_mat_foro_abogados" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="tab-pane fade" id="nav-perito" role="tabpanel" aria-labelledby="nav-perito-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Número de Cédula:</label>
                                                                <input placeholder="Ingrese el número de cédula del perito" class="form-control" required="required" name="psppacjperito_cedula" type="tel">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Nombre:</label>
                                                                <input placeholder="Ingrese el nombre completo del perito" class="form-control" required="required" name="psppacjperito_nombre" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Área:</label>
                                                                <input placeholder="Ingrese el nombre del área" class="form-control" required="required"  name="psppacjperito_area" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Calificación:</label>
                                                                <input placeholder="Ingrese el número de calificación" class="form-control" required="required"  name="psppacjperito_calificacion" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="tab-pane fade" id="nav-vfpago" role="tabpanel" aria-labelledby="nav-vfpago-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Honorarios:</label>
                                                                <input placeholder="Ingrese el valor de los honorarios en letras" class="form-control" required="required" name="psppacjvfpago_honorario_l" type="text">
                                                            </div><div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Honorarios:</label>
                                                                <input placeholder="Ingrese el valor de los honorarios en números" class="form-control" required="required" name="psppacjvfpago_honorario_n" type="number">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Cuota de Entrada:</label>
                                                                <input placeholder="Ingrese el valor de la cuota de entrada en letras" class="form-control" required="required" name="psppacjvfpago_cuota" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div>
        
                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                <label>Domicilio</label>
                                                <input placeholder="Ingrese el domicilio" class="form-control" required="required" name="psppacj_domicilio" type="text">
                                            </div>
                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                            <div class="col-md-4" style="padding-bottom: 15px;">
                                                <input class="btn btn-primary btn-block" type="submit" value="Generar Oficio">
                                            </div>
                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                        </div>
                                    </form>
                                </div>

                                <div class="row" id="oficio_psp" style="display:none">
                                    <form method="POST" action="{{ url('administracion/oficio/contrato_psp') }}" accept-charset="UTF-8">
                                        @csrf
                                        <div class="row ">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Fecha:</label>
                                                <input class="form-control" required="required" name="psp_fecha" type="date">
                                            </div>
        
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Provincia</label>
                                                {!! Form::select('psp_provincia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
        
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Ciudad</label>
                                                {!! Form::select('psp_ciudad', $ciudades, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                <label>Cantón:</label>
                                                <input class="form-control" required="required" name="psp_canton" type="text">
                                            </div>
        
                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                <nav>
                                                    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color: white;">
                                                        <a class="nav-item nav-link active" id="nav-pspcliente-tab" data-toggle="tab" href="#nav-pspcliente" role="tab" aria-controls="nav-pspcliente" aria-selected="true">Cliente</a>
                                                        <a class="nav-item nav-link" id="nav-pspabogado-tab" data-toggle="tab" href="#nav-pspabogado" role="tab" aria-controls="nav-pspabogado" aria-selected="false">Abogado</a>
                                                        <a class="nav-item nav-link" id="nav-pspvfpago-tab" data-toggle="tab" href="#nav-pspvfpago" role="tab" aria-controls="nav-pspvfpago" aria-selected="false">Valor y Forma de Pago</a>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-pspcliente" role="tabpanel" aria-labelledby="nav-pspcliente-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Número de Cédula:</label>
                                                                <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="pspcliente_cedula" type="tel">
                                                            </div>
        
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Nombre:</label>
                                                                <input placeholder="Ingrese el nombre completo del cliente" class="form-control" required="required" name="pspcliente_nombre" type="text">
                                                            </div>
        
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Provincia</label>
                                                                {!! Form::select('pspcliente_provincia', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                                            </div>
        
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Cantón:</label>
                                                                <input placeholder="Ingrese el nombre del cantón" class="form-control" required="required"  name="pspcliente_canton" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Correo Electrónico:</label>
                                                                <input placeholder="Ingrese el correo electrónico del cliente" class="form-control" required="required"  name="pspcliente_correo" type="email">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Causa:</label>
                                                                <input placeholder="Ingrese la causa" class="form-control" required="required" name="pspcliente__causa" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Teléfono:</label>
                                                                <input placeholder="Ingrese el número de teléfono del cliente" class="form-control" required="required" name="pspcliente__telefono" type="tel">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                                <label>Dirección:</label>
                                                                <input placeholder="Ingrese la dirección domiciliaria del cliente" class="form-control" required="required" name="pspcliente__direccion" type="text">
                                                            </div>
                                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                                <label>Calidad:</label>
                                                                <input placeholder="Ingrese la dirección domiciliaria del cliente" class="form-control" required="required" name="pspcliente__calidad" type="text">
                                                            </div>
                                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                                <label>Motivo:</label>
                                                                <input placeholder="Ingrese el motivo por el cuál el perito es contratado, especificando la experticia a realizar" class="form-control" required="required"  name="pspcliente_motivo" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="tab-pane fade" id="nav-pspabogado" role="tabpanel" aria-labelledby="nav-pspabogado-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Número de Cédula:</label>
                                                                <input placeholder="Ingrese el número de cédula del cliente" class="form-control" required="required" name="pspabogado_cedula" type="tel">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Nombre:</label>
                                                                <input placeholder="Ingrese el nombre completo del abogado" class="form-control" required="required" name="pspabogado_nombre" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Calidad:</label>
                                                                <input placeholder="Ingrese la cualidad del abogado" class="form-control" required="required"  name="pspabogado_calidad" type="text">
                                                            </div>
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Mat. Foro de Abogados:</label>
                                                                <input placeholder="Ingrese Mat. foro de abogados" class="form-control" required="required"  name="pspabogado_mat_foro_abogados" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="tab-pane fade" id="nav-pspvfpago" role="tabpanel" aria-labelledby="nav-pspvfpago-tab">
                                                        <div class="row">
                                                            <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Honorarios:</label>
                                                                <input placeholder="Ingrese el valor de los honorarios en letras" class="form-control" required="required" name="pspvfpago_honorario_l" type="text">
                                                            </div><div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Honorarios:</label>
                                                                <input placeholder="Ingrese el valor de los honorarios en números" class="form-control" required="required" name="pspvfpago_honorario_n" type="number">
                                                            </div>
                                                            {{-- <div class="col-md-6" style="padding-bottom: 15px; padding-top: 15px;">
                                                                <label>Cuota de Entrada:</label>
                                                                <input placeholder="Ingrese el valor de la cuota de entrada en letras" class="form-control" required="required" name="pspvfpago_cuota" type="text">
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div>
        
                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                <label>Domicilio</label>
                                                <input placeholder="Ingrese el domicilio" class="form-control" required="required" name="psp_domicilio" type="text">
                                            </div>
                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                            <div class="col-md-4" style="padding-bottom: 15px;">
                                                <input class="btn btn-primary btn-block" type="submit" value="Generar Oficio">
                                            </div>
                                            <div class="col-md-4" style="padding-bottom: 15px;"></div>
                                        </div>
                                    </form>
                                </div>

                                <div class="row" id="oficio_pj" style="display:none">
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
        $( "[name='tipo_oficio']" ).change(function() {
            if(this.value == ""){
                $("#oficio_ca").css("display", "none"); 
                $("#oficio_pj").css("display", "none"); 
                $("#oficio_psp").css("display", "none");
                $("#oficio_psppacj").css("display", "none");
                $("#metodo_oficio").val(this.value);
            }
            if(this.value == "1"){ 
                $("#oficio_ca").css("display", "block"); 
                $("#oficio_pj").css("display", "none"); 
                $("#oficio_psp").css("display", "none");
                $("#oficio_psppacj").css("display", "none");
                $("#metodo_oficio").val(this.value);
            }
            if(this.value == "2"){ 
                $("#oficio_pj").css("display", "block");
                $("#oficio_ca").css("display", "none"); 
                $("#oficio_psp").css("display", "none");
                $("#oficio_psppacj").css("display", "none");
                $("#metodo_oficio").val(this.value);
            }
            if(this.value == "3"){ 
                $("#oficio_psp").css("display", "block");
                $("#oficio_ca").css("display", "none"); 
                $("#oficio_pj").css("display", "none"); 
                $("#oficio_psppacj").css("display", "none");
                $("#metodo_oficio").val(this.value);
            }
            if(this.value == "4"){ 
                $("#oficio_psppacj").css("display", "block");
                $("#oficio_ca").css("display", "none"); 
                $("#oficio_pj").css("display", "none"); 
                $("#oficio_psp").css("display", "none");
                $("#metodo_oficio").val(this.value);
            }
        });
    </script>

@endsection