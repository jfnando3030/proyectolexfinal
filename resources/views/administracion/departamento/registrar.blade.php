@extends('layouts.administracion')

@section('contenido')

    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Registrar departamento </h4>
    </div>

  
    <div class="container-fluid">

        @if (session('mensaje-registro'))
            @include('mensajes.msj_correcto')
        @endif
        @if (session('mensaje-error'))
            @include('mensajes.msj_rechazado')
        @endif

        <div class="emp-profile" style="padding: 3%;">
            {!! Form::open(['route' => ['store_departamento'],'method'=>'POST']) !!}

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Nombres del departamento:</label>
                                                {!! Form::text('nombres', null,['placeholder'=>'Ingrese nombres del departamento','class'=>'form-control', 'required' => 'required', 'onkeypress'=>'return soloLetras(event)']) !!}
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Descripción:</label>
                                                {!! Form::text('descripcion',null,['placeholder'=>'Ingrese una breve descripción del departamento','class'=>'form-control','required' => 'required', 'onkeypress'=>'return soloLetras(event)']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12" style="padding-bottom: 15px;">
                                        </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Provincia</label>
                                                {!! Form::select(
                                                    'inicioDia',
                                                    $dias, 
                                                    null,
                                                    ['class'=>'form-control', 'required' => 'required']) 
                                                    !!}
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Día Final</label>
                                                {!! Form::select(
                                                    'finDia',
                                                    $dias, 
                                                    null,
                                                    ['class'=>'form-control', 'required' => 'required']) 
                                                    !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Horario Inicial</label>
                                                {!! Form::time (
                                                    'inicioHora',
                                                    null,
                                                    ['class'=>'form-control', 'required' => 'required']) 
                                                    !!}
                                            </div>
                                            
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Hora Final</label>
                                                {!! Form::time (
                                                    'finHora',
                                                    null,
                                                    ['class'=>'form-control', 'required' => 'required']) 
                                                    !!}
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
                                {!! Form::submit('Guardar información',['class'=>'btn btn-primary btn-block']) !!}
                            </div>

                            <div class="col-md-4">
                            
                            </div>
                        </div>
                    </div>              
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('script')
    <script src="{{url('registrados/js/validaNumerosLetras.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".rechazado").fadeOut(300);
            },3000);
        });
    </script>
@endsection