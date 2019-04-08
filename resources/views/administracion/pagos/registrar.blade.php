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

<style type="text/css">
    


    section.pricing {

    }

    #body_free, #body_premiun, #body_basic{
        height: 90%;
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
      font-size: 3rem;
      margin: 0;
      color: black;
    }

    .pricing .card-price .period {
      font-size: 0.8rem;
    }

    .pricing ul li {
      margin-bottom: 1rem;
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
        @endif

        <div class="emp-profile" style="padding: 3%;">
            <form action="{{ route('store_pago') }}" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-12" style="padding-bottom: 15px;">
                                                <label>Seleccione el método de pago:</label>
                                                <select class="form-control" id="pago" name="pago" required="">
                                                    <option value=""> Seleccione un departamento</option>
                                                    <option value="TD"> Transferencia o deposito bancario</option>
                                                    <option value="P"> Paypal</option>
                                                </select> 
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;" id="div_pago_td">
                                                <label>Número de comprobante:</label>
                                                {!! Form::text('numero_comprobante',null,['placeholder'=>'Ingrese el número de comprobante','class'=>'form-control']) !!}
                                            </div>

                                            <div class="col-md-6" style="padding-bottom: 15px;" id="div_pago_td2">
                                                <label>Cargar comprobante:</label><br>
                                                <div class="input-group control-group increment" >
                                                    <input  type="file" name="archivo1" id="archivo1"accept="image/*, doc,.docx, .pdf" style="font-size: 13px;">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                
                                                <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

                                                <section class="pricing py-5">
                                                  <div class="container">
                                                    <div class="row">
                                                      <!-- Free Tier -->
                                                      <div class="col-lg-4">
                                                        <div class="card mb-5 mb-lg-0">
                                                          <div class="card-body" id="body_free">
                                                            <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
                                                            <h1 class="card-price text-center">$0<span class="period">/month</span></h1>
                                                            <hr>
                                                            <ul class="fa-ul">
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Single User</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>5GB Storage</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
                                                              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Unlimited Private Projects</li>
                                                              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Dedicated Phone Support</li>
                                                              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Free Subdomain</li>
                                                              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Monthly Status Reports</li>
                                                            </ul>
                                                           
                                                            <hr>
                                                            <center><input type="radio" name="gender" value="F" checked=""> <strong>Seleccionar</strong></center>
                                                            
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <!-- Plus Tier -->
                                                      <div class="col-lg-4">
                                                        <div class="card mb-5 mb-lg-0">
                                                          <div class="card-body" id="body_basic">
                                                            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
                                                            <h1 class="card-price text-center">$9<span class="period">/month</span></h1>
                                                            <hr>
                                                            <ul class="fa-ul">
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>5 Users</strong></li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>50GB Storage</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Private Projects</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Dedicated Phone Support</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Subdomain</li>
                                                              <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Monthly Status Reports</li>
                                                            </ul>
                                                            <hr>
                                                            <center><input type="radio" name="gender" value="B"> <strong>Seleccionar</strong></center>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <!-- Pro Tier -->
                                                      <div class="col-lg-4">
                                                        <div class="card">
                                                          <div class="card-body" id="body_premiun">
                                                            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                                            <h1 class="card-price text-center">$49<span class="period">/month</span></h1>
                                                            <hr>
                                                            <ul class="fa-ul">
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Unlimited Users</strong></li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>150GB Storage</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Private Projects</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Dedicated Phone Support</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Unlimited</strong> Free Subdomains</li>
                                                              <li><span class="fa-li"><i class="fas fa-check"></i></span>Monthly Status Reports</li>
                                                            </ul>
                                                            <hr>
                                                            <center><input type="radio" name="gender" value="P"> <strong>Seleccionar</strong></center>
                                                          </div>
                                                        </div>
                                                      </div>
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