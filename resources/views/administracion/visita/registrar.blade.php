@extends('layouts.administracion')



@section('contenido')

<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 25px;">

    @if($saber_tarifa->count() == 0  or $saber_consultoria != 0 )

        <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
            <h4 style="color: black; text-align:center; font-size:25px;"> Responder solicitud de visita</h4>
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
                                                    <label>Asunto:</label>
                                                    {!! Form::text('nombre',null,['placeholder'=>'Ingrese el título de su solicitud','class'=>'form-control', 'required']) !!}
                                                </div>
                                                <div class="col-md-6" style="padding-bottom: 15px;">
                                                    <br>
                                                    <label>Fecha:</label>
                                                    <input type="date" name="fecha" id="fecha">

                                                    <label>Hora:</label>
                                                    <input type="time" name="hora" id="hora">
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
                                    {!! Form::submit('Enviar',['class'=>'btn btn-primary btn-block']) !!}
                                </div>

                                <div class="col-md-4">
                                
                                </div>
                            </div>
                        </div>              
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @else
        @if($saber_consultoria == 0 ) 
            
            <article style="background:white">  
            <div class="card-body text-center" style="padding-top: 15px;">
                <h4 style="color:red">Lo sentimos, Usted ha superado el limite de envios de solicitudes para consultoría.  </h4>
                <br>
            <p style="color:black; font-size:15px"> Por favor renueva a un nuevo plan</p>  
            <br>
            <p><a class="btn btn-warning letra" target="_self" onclick="return myFunction();" href="{{route('registrar_pago')}}"> Seleccionar Plan  
            <i class="far fa-money-bill-alt"></i></a></p>
            </div>

          </article>
        @else 
          <article style="background:white">  
            <div class="card-body text-center" style="padding-top: 15px;">
                <h4 style="color:red">No tiene un plan de pago activo seleccionado </h4>
                <br>
            <p style="color:black; font-size:15px"> Por favor seleccione un plan</p>  
            <br>
            <p><a class="btn btn-warning letra" target="_self" onclick="return myFunction();" href="{{route('registrar_pago')}}"> Seleccionar Plan  
            <i class="far fa-money-bill-alt"></i></a></p>
            </div>

          </article>
        @endif 
      @endif




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