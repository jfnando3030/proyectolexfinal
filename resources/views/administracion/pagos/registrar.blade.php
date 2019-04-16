@extends('layouts.administracion')
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#pago').change(function(e) {
            if( $('#pago').val() == "P"){
                $('#div_pago_td').hide();
                $('#div_pago_td2').hide();
                $('#btn_guardar').show();
            }else{
                $('#div_pago_td').show();
                $('#div_pago_td2').show();
                $('#btn_guardar').show();
            }
           
        });
    });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var aux = 1;
    $('input[type=radio][name=rb]').on('change', function() {
      $('#rb-' + aux).css("border-style", "solid");
      $('#rb-' + aux).css("border-color", "black");
      
      var x = $(this).attr("value");

      var y = $('#precio-' + x).text();

      if(y == "$ 0.00/Mes"){
        $('#div_pago_td1').hide();
        $('#div_pago_td2').hide();
      }else{
        $('#div_pago_td1').show();
        $('#div_pago_td2').show();
      }

      $('#rb-' + x).css("border-style", "solid");
      $('#rb-' + x).css("border-color", "#0075f6");
      aux = x;
    }); 
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var aux1 = 2;
    $('input[type=radio][name=rbp]').on('change', function() {
      $('#rbp-' + aux1).css("border-style", "solid");
      $('#rbp-' + aux1).css("border-color", "black");
      
      var y = $(this).attr("value");

      $('#rbp-' + y).css("border-style", "solid");
      $('#rbp-' + y).css("border-color", "#0075f6");
      aux1 = y;
    }); 
  });
</script>


<style type="text/css">

    section.pricing {

    }

    .pt-5, .py-5 {
      padding-top: 0rem!important;
      padding-bottom: 1rem!important;
    }
    .pricing .card {
      border: none;
      border-radius: 1rem;
      transition: all 0.2s;
      box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .pricing hr {
      margin: 1.5rem 0;
    }

    .pricing .card-title {
      margin: 0.5rem 0;
      font-size: 0.9rem;
      letter-spacing: .1rem;
      font-weight: bold;
    }

    .pricing .card-price {
      font-size: 2rem;
      margin: 0;
      color: black;
    }

    .pricing .card-price .period {
      font-size: 0.8rem;
    }

    .pricing ul li {
      margin-bottom: 0.2rem;
      font-size: 14px;
    }

    .pricing .text-muted {
      opacity: 0.7;
    }

    .pricing .btn {
      font-size: 80%;
      border-radius: 5rem;
      letter-spacing: .1rem;
      font-weight: bold;
      padding: 1rem;
      opacity: 0.7;
      transition: all 0.2s;
    }

    .col-lg-4{
      padding-left: 0px;
    }

    textarea{
      padding: 2px 0px 0px 25px;
      height: 120px;
      resize: none;
    }

    /* Hover Effects on Card */

    @media (min-width: 992px) {
      .pricing .card:hover {
        margin-top: -.25rem;
        margin-bottom: .25rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
      }
      .pricing .card:hover .btn {
        opacity: 1;
      }
    }

</style>


@section('contenido')

    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Registrar pagos </h4>
    </div>

  
    <div class="container-fluid">

        @if (session('mensaje-registro'))
          @include('mensajes.msj_correcto')
        @else
          @include('mensajes.msj_rechazado')
        @endif

        <div class="emp-profile" style="padding: 3%;">

          <div class="card-body">
            <div class="custom-tab">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color: white;">
                  <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home"
                   aria-selected="true">Deposito </a>
                  <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile"
                   aria-selected="false"> Paypal </a>
                </div>
              </nav>
              <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                  
                  <form action="{{ route('store_pago') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <div class="row">
                        <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        

                                        <div class="col-md-12">
                                          <label>Plan de pagos</label>
                                          <section class="pricing py-5">
                                            <div class="container">
                                              <div class="row">
                                                <!-- Free Tier -->
                                                <?php $x = 1; ?>
                                                @foreach( $tarifa as $tarifa)
                                                <div class="col-md-4" style="padding-left: 2px;">
                                                  <div class="card-body" style="padding-left: 2px; width: 100%;" >
                                                    @if($x == 1 )
                                                      <div class="card mb-5 mb-lg-0" id="rb-{{$tarifa->id}}" style="border-style: solid; border-color: #0075f6;">
                                                    @else
                                                      <div class="card mb-5 mb-lg-0" id="rb-{{$tarifa->id}}" style="border-style: solid; border-color: solid;">
                                                    @endif
                                                      <h5 class="card-title text-muted text-uppercase text-center">{{ $tarifa->tarifa }} </h5>
                                                      <h4 class="card-price text-center" id="precio-{{$tarifa->id}}">$ {{ $tarifa->precio }}<span class="period">/Mes</span></h4>
                                                      <hr>
                                                        @if($x == 1 )
                                                          <ul class="fa-ul">
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultoría <small>(2/mes)</small></li>
                                                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Elaboración de documentos </li>
                                                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Asesoría</li>

                                                          </ul>
                                                        @endif
                                                        @if($x == 2 )
                                                          <ul class="fa-ul">
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultoría <small> (2/mes)</small> </li>
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Elaboración de documentos <small> (2/mes)</small></li>
                                                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Asesoría</li>
                                                          </ul>
                                                        @endif
                                                        @if($x == 3 )
                                                          <ul class="fa-ul">
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultoría</li>
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Elaboración de documentos</li>
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Asesoría legal</li>
                                                          </ul>
                                                        @endif
                                                      <br>
                                                      @if($x == 1 )
                                                      <center><input type="radio" name="rb" id="rb_plan" value="{{$tarifa->id}}" checked="" > <strong>Seleccionar</strong></center>
                                                      @else
                                                        <center><input type="radio" name="rb" id="rb_plan" value="{{$tarifa->id}}" > <strong>Seleccionar</strong></center>
                                                      @endif
                                                      <br>
                                                    </div>
                                                  </div>
                                                </div>
                                                <?php $x = $x + 1; ?>
                                                @endforeach                                               
                                              </div>
                                            </div>
                                          </section>
                                        </div>   

                                        
                                        <div class="col-md-6" style="padding-bottom: 15px;" id="div_pago_td1">
                                            <label>Número de comprobante:</label>
                                            {!! Form::text('numero_comprobante',null,['placeholder'=>'Ingrese el número de comprobante','class'=>'form-control', 'required' ]) !!}
                                        </div>

                                        <div class="col-md-6" style="padding-bottom: 15px;" id="div_pago_td2">
                                            <label>Cargar comprobante:</label><br>
                                            <div class="input-group control-group increment" >
                                                <input  type="file" name="archivo1" id="archivo1"accept="image/*, doc,.docx, .pdf" style="font-size: 13px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                                            
                            </div>

                            <div class="col-md-4" style="padding-bottom: 15px;" id="btn_guardar">
                                {!! Form::submit('Guardar información',['class'=>'btn btn-primary btn-block']) !!}
                            </div>

                            <div class="col-md-4">
                                
                            </div>
                    
                    </div>  
                  {!! Form::close() !!}

                </div>
                <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                  
                  <form action="{{ route('paypal') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <div class="row">
                        <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                      
                                        <div class="col-md-12">
                                          <label>PLAN DE PAGO</label>
                                          <section class="pricing py-5">
                                            <div class="container">
                                              <div class="row">
                                                <!-- Free Tier -->
                                                <?php $y = 1; ?>
                                                @foreach( $tarifa2 as $tarifa2)
                                                <div class="col-lg-4" >
                                                  <div class="card-body" >
                                                    @if($y == 1 )
                                                      <div class="card mb-5 mb-lg-0" id="rbp-{{$tarifa2->id}}" style="border-style: solid; border-color: #0075f6;">
                                                    @else
                                                      <div class="card mb-5 mb-lg-0" id="rbp-{{$tarifa2->id}}" style="border-style: solid; border-color: solid;">
                                                    @endif
                                                      <h5 class="card-title text-muted text-uppercase text-center">{{ $tarifa2->tarifa }} </h5>
                                                      <h4 class="card-price text-center" id="precio-{{$tarifa2->id}}">$ {{ $tarifa2->precio }}<span class="period">/Mes</span></h4>
                                                      <hr>
                                                      @if($y == 1 )
                                                          <ul class="fa-ul">
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultoría <small>(2/mes)</small></li>
                                                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Elaboración de documentos </li>
                                                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Asesoría</li>

                                                          </ul>
                                                        @endif
                                                        @if($y == 2 )
                                                          <ul class="fa-ul">
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultoría <small> (2/mes)</small> </li>
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Elaboración de documentos <small> (2/mes)</small></li>
                                                            <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Asesoría</li>
                                                          </ul>
                                                        @endif
                                                        @if($y == 3 )
                                                          <ul class="fa-ul">
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Consultoría</li>
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Elaboración de documentos</li>
                                                            <li><span class="fa-li"><i class="fas fa-check"></i></span>Asesoría legal</li>
                                                          </ul>
                                                        @endif
                                                      <br>
                                                      @if($y == 1 )
                                                      <center><input type="radio" name="rbp" id="rb_plan" value="{{$tarifa2->id}}" checked="" > <strong>Seleccionar</strong></center>
                                                      @else
                                                        <center><input type="radio" name="rbp" id="rb_plan" value="{{$tarifa2->id}}" > <strong>Seleccionar</strong></center>
                                                      @endif
                                                      <br>
                                                    </div>
                                                  </div>
                                                </div>
                                                <?php $y = $y + 1; ?>
                                                @endforeach                                               
                                              </div>
                                            </div>
                                          </section>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                                            
                            </div>

                            <div class="col-md-4" style="padding-bottom: 15px;" id="btn_guardar">
                                {!! Form::submit('Guardar información',['class'=>'btn btn-primary btn-block']) !!}
                            </div>

                            <div class="col-md-4">
                                
                            </div>
                    
                    </div>  
                  {!! Form::close() !!}

                </div>
              </div>

            </div>
          </div>
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