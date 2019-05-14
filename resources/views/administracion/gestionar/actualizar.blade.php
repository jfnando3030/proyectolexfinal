@extends('layouts.administracion')

@section('contenido')

    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Gestionar casos con abogado </h4>
    </div>

  
    <div class="container-fluid">

        @if (session('mensaje-registro'))
            @include('mensajes.msj_correcto')
        @endif

        <div class="emp-profile" style="padding: 3%;">
            <form action="{{ route('actualizar_abogado_caso') }}" method="get">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="ip_valor1" value="" id="ip_valor1">
                <input type="hidden" name="navegador1" value="" id="navegador1">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    	<input type="hidden" name="id" id="id" value=" {{ $solicitud[0]->id }} ">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Nombre del caso:</label>
                                                <hr>
                                                <p style="color: gray;"> {{ $solicitud[0]->nombre_solicitud }} </p>
                                                <hr>
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Departamento:</label>
                                                <hr>
                                                <p style="color: gray;"> {{ $solicitud[0]->nombre_departamento }} </p>
                                                <hr>
                                            </div>
                                            
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Abogado a cargo:</label>
                                                <p style="color: gray;"> {{ $abogado[0]->nombres }} {{ $abogado[0]->apellidos }} </p>
                                                <hr>
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label> Cambiar de abogado:</label>
                                                <select class="form-control" id="abogado" name="abogado" required="">
                                                    <option value=""> Seleccione un abogado</option>
                                                    @foreach($abogados as $abogados)
                                                        <option value="{{ $abogados->id }}"> {{ $abogados->nombres }} {{ $abogados->apellidos }} </option>
                                                    @endforeach
                                                </select> 
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
           </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{url('administration/dist/js/validaNumerosLetras.js')}}"></script>
@endsection