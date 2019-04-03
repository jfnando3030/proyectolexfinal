@extends('layouts.administracion')



@section('contenido')

    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Registrar solicitud </h4>
    </div>

  
    <div class="container-fluid">

        @if (session('mensaje-registro'))
            @include('mensajes.msj_correcto')
        @endif

        <div class="emp-profile" style="padding: 3%;">
            <form action="{{ route('store_solicitud') }}" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Detalle su petición:</label>
                                                <textarea name="solicitud" id="solicitud" rows="11" placeholder="Escriba su solicitud...    " class="form-control" required="" style="background-color: currentColor;"></textarea> 
                                            </div>

                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Seleccione el departamento:</label>
                                                <select class="form-control" id="departamento" name="departamento" required="">
                                                    <option value=""> Seleccione un departamento</option>
                                                    @foreach($departamento as $departamento)
                                                        <option value="{{ $departamento->id }}"> {{ $departamento->nombre_departamento }}</option>
                                                    @endforeach
                                                </select> 
                                                <label>Cargar archivos:</label><br>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo1" id="archivo1" class="form-control" accept="image/*, doc,.docx, .pdf" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: red; font-size: 11px;" id="x1">X</button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo2" id="archivo2" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: red; font-size: 11px;" id="x2"></i>X</button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo3" id="archivo3" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: red; font-size: 11px;" id="x3"></i>X</button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo4" id="archivo4" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: red; font-size: 11px;" id="x4"></i>X</button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo5" id="archivo5" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: red; font-size: 11px;" id="x5"></i>X</button>
                                                  </div>
                                                </div>
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
    <script>
        $("#x1").on( "click", function() {
            $("#archivo1").val("");
        });
        $("#x2").on( "click", function() {
            $("#archivo2").val("");
        });
        $("#x3").on( "click", function() {
            $("#archivo3").val("");
        });
        $("#x4").on( "click", function() {
            $("#archivo4").val("");
        });
        $("#x5").on( "click", function() {
            $("#archivo5").val("");
        });
    </script>

@endsection