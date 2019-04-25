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
                                                <input class="form-control" required="required" name="oca_mo" type="hidden">
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
                                                <input class="form-control" required="required" name="psppacj_mo" type="hidden">
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
                                                <input class="form-control" required="required" name="psp_mo" type="hidden">
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
                                                                <input placeholder="Ingrese la cualidad del cliente" class="form-control" required="required" name="pspcliente__calidad" type="text">
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
                                                <input class="form-control" required="required" name="pj_mo" type="hidden">
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
                                                <label>Provincia</label>
                                                {!! Form::select('opj_provinciauji', $provincias, null, ['class'=>'form-control', 'required' => 'required']) !!}
                                            </div>

                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Cantón:</label>
                                                <input placeholder="Ingrese el cantón donde está ubicada la institución" class="form-control" required="required" onkeypress="return soloLetras(event)" name="opj_cantonuji" type="text">
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
                $("[name=oca_mo]").val("");
                $("[name=pj_mo]").val("");
                $("[name=psp_mo]").val("");
                $("[name=psppacj_mo]").val("");
            }
            if(this.value == "1"){ 
                $("#oficio_ca").css("display", "block"); 
                $("#oficio_pj").css("display", "none"); 
                $("#oficio_psp").css("display", "none");
                $("#oficio_psppacj").css("display", "none");
                $("[name=oca_mo]").val(this.value);
            }
            if(this.value == "2"){ 
                $("#oficio_pj").css("display", "block");
                $("#oficio_ca").css("display", "none"); 
                $("#oficio_psp").css("display", "none");
                $("#oficio_psppacj").css("display", "none");
                $("[name=pj_mo]").val(this.value);
            }
            if(this.value == "3"){ 
                $("#oficio_psp").css("display", "block");
                $("#oficio_ca").css("display", "none"); 
                $("#oficio_pj").css("display", "none"); 
                $("#oficio_psppacj").css("display", "none");
                $("[name=psp_mo]").val(this.value);
            }
            if(this.value == "4"){ 
                $("#oficio_psppacj").css("display", "block");
                $("#oficio_ca").css("display", "none"); 
                $("#oficio_pj").css("display", "none"); 
                $("#oficio_psp").css("display", "none");
                $("[name=psppacj_mo]").val(this.value);
            }
        });

        $("[name='oca_pronvicia']").change(function(){
            ocultarCiudadesA();
            
            if(this.value == "1"){ mostrarCiudadesA(1, 9); }
            if(this.value == "2"){ mostrarCiudadesA(10, 14); }
            if(this.value == "3"){ mostrarCiudadesA(15, 18); }
            if(this.value == "4"){ mostrarCiudadesA(19, 26); }
            if(this.value == "5"){ mostrarCiudadesA(27, 40); } 
            if(this.value == "6"){ mostrarCiudadesA(41, 55); } 
            if(this.value == "7"){ mostrarCiudadesA(56, 69); } 
            if(this.value == "8"){ mostrarCiudadesA(70, 85); } 
            if(this.value == "9"){ mostrarCiudadesA(86, 89); } 
            if(this.value == "10"){ mostrarCiudadesA(90, 110); } 
            if(this.value == "11"){ mostrarCiudadesA(111, 120); } 
            if(this.value == "12"){ mostrarCiudadesA(121, 135); } 
            if(this.value == "13"){ mostrarCiudadesA(136, 145); } 
            if(this.value == "14"){ mostrarCiudadesA(146, 165); } 
            if(this.value == "15"){ mostrarCiudadesA(166, 170); } 
            if(this.value == "16"){ mostrarCiudadesA(171, 175); } 
            if(this.value == "17"){ mostrarCiudadesA(176, 179); }
            if(this.value == "18"){ mostrarCiudadesA(180, 185); } 
            if(this.value == "19"){ mostrarCiudadesA(186, 217); } 
            if(this.value == "20"){ mostrarCiudadesA(218, 220); } 
            if(this.value == "21"){ mostrarCiudadesA(221, 224); } 
            if(this.value == "22"){ mostrarCiudadesA(225, 232); } 
            if(this.value == "23"){ mostrarCiudadesA(233, 243); } 
            if(this.value == "24"){ mostrarCiudadesA(244, 248); } 
        });

        function mostrarCiudadesA(desde, hasta){
            for (var index = desde; index <= hasta; index++) {
                $("[name='oca_ciudad']").find("option:eq("+index+")").show();
            }
        }

        function ocultarCiudadesA(){
            for (var index = 1; index <= 257; index++) {
                $("[name='oca_ciudad']").find("option:eq("+index+")").hide();
            }
        }

        $("[name='psppacj_provincia']").change(function(){
            ocultarCiudadesB();
            
            if(this.value == "1"){ mostrarCiudadesB(1, 9); }
            if(this.value == "2"){ mostrarCiudadesB(10, 14); }
            if(this.value == "3"){ mostrarCiudadesB(15, 18); }
            if(this.value == "4"){ mostrarCiudadesB(19, 26); }
            if(this.value == "5"){ mostrarCiudadesB(27, 40); } 
            if(this.value == "6"){ mostrarCiudadesB(41, 55); } 
            if(this.value == "7"){ mostrarCiudadesB(56, 69); } 
            if(this.value == "8"){ mostrarCiudadesB(70, 85); } 
            if(this.value == "9"){ mostrarCiudadesB(86, 89); } 
            if(this.value == "10"){ mostrarCiudadesB(90, 110); } 
            if(this.value == "11"){ mostrarCiudadesB(111, 120); } 
            if(this.value == "12"){ mostrarCiudadesB(121, 135); } 
            if(this.value == "13"){ mostrarCiudadesB(136, 145); } 
            if(this.value == "14"){ mostrarCiudadesB(146, 165); } 
            if(this.value == "15"){ mostrarCiudadesB(166, 170); } 
            if(this.value == "16"){ mostrarCiudadesB(171, 175); } 
            if(this.value == "17"){ mostrarCiudadesB(176, 179); }
            if(this.value == "18"){ mostrarCiudadesB(180, 185); } 
            if(this.value == "19"){ mostrarCiudadesB(186, 217); } 
            if(this.value == "20"){ mostrarCiudadesB(218, 220); } 
            if(this.value == "21"){ mostrarCiudadesB(221, 224); } 
            if(this.value == "22"){ mostrarCiudadesB(225, 232); } 
            if(this.value == "23"){ mostrarCiudadesB(233, 243); } 
            if(this.value == "24"){ mostrarCiudadesB(244, 248); } 
        });

        function mostrarCiudadesB(desde, hasta){
            for (var index = desde; index <= hasta; index++) {
                $("[name='psppacj_ciudad']").find("option:eq("+index+")").show();
            }
        }

        function ocultarCiudadesB(){
            for (var index = 1; index <= 257; index++) {
                $("[name='psppacj_ciudad']").find("option:eq("+index+")").hide();
            }
        }


        $("[name='psp_provincia']").change(function(){
            ocultarCiudadesC();
            
            if(this.value == "1"){ mostrarCiudadesC(1, 9); }
            if(this.value == "2"){ mostrarCiudadesC(10, 14); }
            if(this.value == "3"){ mostrarCiudadesC(15, 18); }
            if(this.value == "4"){ mostrarCiudadesC(19, 26); }
            if(this.value == "5"){ mostrarCiudadesC(27, 40); } 
            if(this.value == "6"){ mostrarCiudadesC(41, 55); } 
            if(this.value == "7"){ mostrarCiudadesC(56, 69); } 
            if(this.value == "8"){ mostrarCiudadesC(70, 85); } 
            if(this.value == "9"){ mostrarCiudadesC(86, 89); } 
            if(this.value == "10"){ mostrarCiudadesC(90, 110); } 
            if(this.value == "11"){ mostrarCiudadesC(111, 120); } 
            if(this.value == "12"){ mostrarCiudadesC(121, 135); } 
            if(this.value == "13"){ mostrarCiudadesC(136, 145); } 
            if(this.value == "14"){ mostrarCiudadesC(146, 165); } 
            if(this.value == "15"){ mostrarCiudadesC(166, 170); } 
            if(this.value == "16"){ mostrarCiudadesC(171, 175); } 
            if(this.value == "17"){ mostrarCiudadesC(176, 179); }
            if(this.value == "18"){ mostrarCiudadesC(180, 185); } 
            if(this.value == "19"){ mostrarCiudadesC(186, 217); } 
            if(this.value == "20"){ mostrarCiudadesC(218, 220); } 
            if(this.value == "21"){ mostrarCiudadesC(221, 224); } 
            if(this.value == "22"){ mostrarCiudadesC(225, 232); } 
            if(this.value == "23"){ mostrarCiudadesC(233, 243); } 
            if(this.value == "24"){ mostrarCiudadesC(244, 248); } 
        });

        function mostrarCiudadesC(desde, hasta){
            for (var index = desde; index <= hasta; index++) {
                $("[name='psp_ciudad']").find("option:eq("+index+")").show();
            }
        }

        function ocultarCiudadesC(){
            for (var index = 1; index <= 257; index++) {
                $("[name='psp_ciudad']").find("option:eq("+index+")").hide();
            }
        }

        $("[name='ocalocal_provincia']").change(function(){
            ocultarCiudadesD();
            
            if(this.value == "1"){ mostrarCiudadesD(1, 9); }
            if(this.value == "2"){ mostrarCiudadesD(10, 14); }
            if(this.value == "3"){ mostrarCiudadesD(15, 18); }
            if(this.value == "4"){ mostrarCiudadesD(19, 26); }
            if(this.value == "5"){ mostrarCiudadesD(27, 40); } 
            if(this.value == "6"){ mostrarCiudadesD(41, 55); } 
            if(this.value == "7"){ mostrarCiudadesD(56, 69); } 
            if(this.value == "8"){ mostrarCiudadesD(70, 85); } 
            if(this.value == "9"){ mostrarCiudadesD(86, 89); } 
            if(this.value == "10"){ mostrarCiudadesD(90, 110); } 
            if(this.value == "11"){ mostrarCiudadesD(111, 120); } 
            if(this.value == "12"){ mostrarCiudadesD(121, 135); } 
            if(this.value == "13"){ mostrarCiudadesD(136, 145); } 
            if(this.value == "14"){ mostrarCiudadesD(146, 165); } 
            if(this.value == "15"){ mostrarCiudadesD(166, 170); } 
            if(this.value == "16"){ mostrarCiudadesD(171, 175); } 
            if(this.value == "17"){ mostrarCiudadesD(176, 179); }
            if(this.value == "18"){ mostrarCiudadesD(180, 185); } 
            if(this.value == "19"){ mostrarCiudadesD(186, 217); } 
            if(this.value == "20"){ mostrarCiudadesD(218, 220); } 
            if(this.value == "21"){ mostrarCiudadesD(221, 224); } 
            if(this.value == "22"){ mostrarCiudadesD(225, 232); } 
            if(this.value == "23"){ mostrarCiudadesD(233, 243); } 
            if(this.value == "24"){ mostrarCiudadesD(244, 248); } 
        });

        function mostrarCiudadesD(desde, hasta){
            for (var index = desde; index <= hasta; index++) {
                $("[name='ocalocal_ciudad']").find("option:eq("+index+")").show();
            }
        }

        function ocultarCiudadesD(){
            for (var index = 1; index <= 257; index++) {
                $("[name='ocalocal_ciudad']").find("option:eq("+index+")").hide();
            }
        }


        
        
    </script>

@endsection