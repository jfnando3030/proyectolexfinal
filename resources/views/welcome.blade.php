<!doctype html>
<html lang="en">
  <head>
   

    <title>Wilson Merino & Asociados - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <link rel="icon" href="{{ asset('frontend/images/icon.png') }}">
    <!-- animations CSS -->
    <link rel="stylesheet" href="{{url('frontend/css/animate.min.css')}}">
    <!-- font-awsome CSS -->
    <link rel="stylesheet" href="{{url('frontend/css/font-awesome.min.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}">
    <!-- mobile menu CSS -->
    <link rel="stylesheet" href="{{url('frontend/css/slicknav.min.css')}}">
    <!--css animation-->
    <link rel="stylesheet" href="{{url('frontend/css/animation.css')}}">
    <!--css animation-->
    <link rel="stylesheet" href="{{url('frontend/css/material-design-iconic-font.min.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{url('frontend/css/style.css')}}">
    <!-- responsive CSS -->
    <link rel="stylesheet" href="{{url('frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{url('css/mensajes.css')}}">
    <link rel="stylesheet" href="{{url('css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{url('css/alertify.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  </head>
  <body>

        <div class="loader"></div>

    <div class="welcome-area" id="home">
      
        <div class="container banner2">

        

          <div class="row">
           

            <div class="col-xl-4 col-lg-4 col-md-2 col-sm-12 col-12">
                    
                </div>

                <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">

            <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <a href="{{url('/')}}" onclick="return myFunction();" title="Ir al inicio">  <img src="{{url('frontend/images/redondo.png')}}" class="brand_logo" alt="Logo"> </a>
                        </div> 

                     
                    </div>
                    <div class="d-flex justify-content-center form_container">

                         
                        
                           
                        <form style="width: 100%;" method="POST" action="{{ route('login') }}">
                                <div align="center">
                                        <label style="color:white;     font-weight: bold;font-size: 20px;"> Wilson Merino & Asociados </label>
        
                                        </div>
                        @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                    <input type="hidden" name="ip_valor" value="" id="ip_valor">
                                    <input type="hidden" name="navegador" value="" id="navegador">
                                    <div class="row">

                                        @if (session('mensaje-registro'))
                                            @include('mensajes.msj_correcto')
                                        @endif
                            
                                        @if (session('mensaje-error'))
                                            @include('mensajes.msj_rechazado')
                                        @endif
                            
                                    </div>

                                    @if ($errors->has('cedula'))
                                    <span >
                                        <strong style="color:white; padding-bottom:10px;">{{ $errors->first('cedula') }}</strong>
                                    </span>
                                     @endif

                                     <br>
                                    
                            <div class="input-group mb-3{{ $errors->has('cedula') ? ' has-error' : '' }}">

                             
                                
                    
                                    <span  class="input-group-text"><i class="fas fa-user" style="    padding-right: 3px;"></i></span>
                                
                                <input id="cedula" class="form-control" name="cedula" placeholder="Ingrese su cédula"  value="{{ old('cedula') }}" required autofocus>
                              
                             
                            </div>
                            <div class="input-group mb-2{{ $errors->has('password') ? ' has-error' : '' }}">

                                @if ($errors->has('password'))
                                <span >
                                            <strong style="color:white; padding-bottom:10px;">{{ $errors->first('password') }}</strong>
                                </span>
                                    @endif

                                    <br>
                               
                                    <span  class="input-group-text"><i class="fas fa-key"></i></span>
                                
                                    <input id="password" type="password" class="form-control" placeholder="Ingrese su contraseña" name="password" required>
                                   
                                  
                            </div>
                            <div align="center" class="form-group">
                                <div class="custom-control custom-checkbox">
                                 

                                        <label class="container_check">Mostrar contraseña
                                            <input type="checkbox" onclick="mostrarPass()">
                                            <span class="checkmark"></span>
                                          </label>

                           
                                    
                                </div>
                            </div>
                        
                    </div>
                    <div class="d-flex justify-content-center login_container">
                        <button type="submit" name="button" class="btn login_btn">Ingresar</button>
                    </div>
                    <div class="mt-2">
                        <div class="d-flex justify-content-center links">
                           ¿No tienes una cuenta? <a style="font-weight: bold;" href="{{ route('register') }}" onclick="return myFunction();" class="ml-2">Regístrate aquí</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                                <a style="font-weight: bold;" href="{{ route('password.request') }}" onclick="return myFunction();">
                                       ¿Olvidaste la contraseña?
                                    </a>
                        </div>
                    </div>

                  </form>
                </div>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-2 col-sm-12 col-12">
                    
                </div>

            </div>
            
        </div>
    </div>
    <!--welcome area end-->



 

    <!-- jquery 2.2.4 js-->
    <script src="{{url('frontend/js/jquery-2.2.4.min.js')}}"></script>
    <!-- popper js-->
    <script src="{{url('frontend/js/popper.js')}}"></script>
    <!-- wow js-->
    <script src="{{url('frontend/js/wow.min.js')}}"></script>
    <!-- bootstrap js-->
    <script src="{{url('frontend/js/bootstrap.min.js')}}"></script>

    <!--mobile menu js-->
    <script src="{{url('frontend/js/jquery.slicknav.min.js')}}"></script>

   
    <!-- main js-->
    <script src="{{url('frontend/js/main.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".aprobado").fadeOut(300);
            },3000);
        });
    </script>



<script type="text/javascript">
   
    $(window).on('load', function(){ 
        $(".loader").fadeOut("slow");

    });

    function myFunction() {
            $(".loader").show();
       
        }

    </script>

<script>
    function mostrarPass() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>

  </body>

  <script type="text/javascript">
  
    $(document).ready(function() {
        setTimeout(function() {
           
            $(".error").fadeOut(300);

        },3000);

        



        
      var findIP = new Promise(r=>{var w=window,a=new (w.RTCPeerConnection||w.mozRTCPeerConnection||w.webkitRTCPeerConnection)({iceServers:[]}),b=()=>{};a.createDataChannel("");a.createOffer(c=>a.setLocalDescription(c,b,b),b);a.onicecandidate=c=>{try{c.candidate.candidate.match(/([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g).forEach(r)}catch(e){}}})

       findIP.then((ip)=>{document.getElementById("ip_valor").value=ip}).catch(e => console.error(e));

       if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
    {
        document.getElementById("navegador").value="Opera";
    }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
    {
        document.getElementById("navegador").value="Chrome";
    }
    else if(navigator.userAgent.indexOf("Safari") != -1)
    {
        document.getElementById("navegador").value="Safari";
    }
    else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
    {
        document.getElementById("navegador").value="Firefox";
    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
        document.getElementById("navegador").value="Internet Explore";
    }  

    else if (window.navigator.userAgent.indexOf("Edge") > -1)
    {
        document.getElementById("navegador").value="Microsoft Edge";
    }

    else 
    {
        document.getElementById("navegador").value="Desconocido";
    }

        
    });


  </script>


</html>
