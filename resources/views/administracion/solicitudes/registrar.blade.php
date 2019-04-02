@extends('layouts.administracion')

@section('contenido')

    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Registrar departamento </h4>
    </div>

  
    <div class="container-fluid">

        @if (session('mensaje-registro'))
            @include('mensajes.msj_correcto')
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
                                                <textarea name="solicitud" id="solicitud" rows="5" placeholder="Escriba su solicitud" class="form-control"></textarea> 
                                            </div>

                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Cargar archivos:</label><br>
                                                <div class="control-group input-group" style="margin-top:10px">
                                                    <input type="file" name="filename[]" class="form-control">
                                                    <div class="input-group-btn"> 
                                                      <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
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
@endsection