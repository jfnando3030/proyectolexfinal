@extends('layouts.administracion')

@section('contenido')

    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Actualizar información del departamento </h4>
    </div>

  
    <div class="container-fluid">

        @if (session('mensaje-registro'))
            @include('mensajes.msj_correcto')
        @endif

        <div class="emp-profile" style="padding: 3%;">
            {!! Form::open(['route' => ['editar_departamento'],'method'=>'PUT']) !!}
            <input type="hidden" name="ip_valor1" value="" id="ip_valor1">
            <input type="hidden" name="navegador1" value="" id="navegador1">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    	<input type="hidden" name="id" id="id" value="{{ $departamento->id }}">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Nombres del departamento:</label>
                                                <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $departamento->nombre_departamento }} ">
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Descripción:</label>
                                                <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $departamento->descripcion_departamento }} ">
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
    <script src="{{url('administration/dist/js/validaNumerosLetras.js')}}"></script>
@endsection