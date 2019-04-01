<!doctype html>
<html lang="en">
    <head>
        <title>Registro Usuarios</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- carousel CSS -->
        
        <link rel="stylesheet" href="{{url('frontend/css/owl.carousel.min.css')}}">
        <!--header icon CSS -->
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

        <!--welcome area start-->
        <div class="welcome-area" id="home">
          
            <div class="container banner3">
                <div class="row">

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                        
                    </div>

                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

                        <div class="user_card">
                            <div class="d-flex justify-content-center">
                                <div class="brand_logo_container">
                                    <a href="{{url('/')}}" onclick="return myFunction();" title="Ir al inicio">  <img src="{{url('frontend/images/redondo.png')}}" class="brand_logo" alt="Logo"> </a>
                                </div> 
                            </div>
                            <div class="d-flex justify-content-center form_container">
                                
                                <form style="width: 100%;" method="POST" action="{{ route('registrado') }}">
                                @csrf

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                    <div class="row">

                                        @if (session('mensaje-registro'))
                                            @include('mensajes.msj_correcto')
                                        @endif
                            
                                        @if (session('mensaje-error'))
                                            @include('mensajes.msj_rechazado')
                                        @endif


                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-bottom:15px">
                                            @if ($message = Session::get('warning'))
                                                <div class="alert alert-warning alert-block">
                                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('cedula') ? ' has-error' : '' }}">
                                                <span  class="input-group-text" style="font-size:22px"><i class="fas fa-address-card" style="    padding-right: 3px;"></i></span>   
                                                <input id="cedula" type="text" class="form-control" name="cedula" placeholder="Ingrese su cédula"  value="{{ old('cedula') }}" required >
                                            </div>

                                            @if ($errors->has('cedula'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('cedula') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('nombres') ? ' has-error' : '' }}">
                                                <span  class="input-group-text"><i class="fas fa-user" style="    padding-right: 3px;"></i></span>   
                                                <input id="nombres" type="text" class="form-control" name="nombres" placeholder="Ingrese sus nombres"  value="{{ old('nombres') }}" required >
                                            </div>

                                            @if ($errors->has('nombres'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nombres') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                                                <span  class="input-group-text"><i class="fas fa-user" style="    padding-right: 3px;"></i></span>   
                                                <input id="apellidos" type="text" class="form-control" name="apellidos" placeholder="Ingrese sus apellidos"  value="{{ old('apellidos') }}" required >
                                            </div>

                                            @if ($errors->has('apellidos'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('email') ? ' has-error' : '' }}">
                                               
                                                <span  class="input-group-text"><i class="fas fa-envelope" style="    padding-right: 3px;"></i></span>   
                                                <input id="email" type="email" class="form-control" name="email" placeholder="Ingrese su email"  value="{{ old('email') }}" required>
                                            </div>

                                            @if ($errors->has('email'))
                                                <span >
                                                    <strong style="color:white; padding-bottom:10px;">{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                                <span  class="input-group-text"><i class="fas fa-phone" style="    padding-right: 3px;"></i></span>   
                                                <input id="telefono" type="text" class="form-control" name="telefono" placeholder="Ingrese número de teléfono"  value="{{ old('telefono') }}" required >
                                            </div>

                                            @if ($errors->has('telefono'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('celular') ? ' has-error' : '' }}">
                                                <span  class="input-group-text"><i class="fas fa-phone" style="    padding-right: 3px;"></i></span>   
                                                <input id="celular" type="text" class="form-control" name="celular" placeholder="Ingrese su número de celular"  value="{{ old('celular') }}" required >
                                            </div>

                                            @if ($errors->has('celular'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('celular') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
                                              
                                               
                                                <span  class="input-group-text"><i class="fas fa-key"></i></span>
                                                <input id="password" type="password" class="form-control" placeholder="Ingrese su contraseña" name="password" required>  
                                            </div>

                                            @if ($errors->has('password'))
                                                <span >
                                                    <strong style="color:white; padding-bottom:10px;">{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="input-group mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <span  class="input-group-text"><i class="fas fa-key"></i></span>
                                                <input id="password-confirm" type="password" class="form-control" placeholder="Validar contraseña" name="password_confirmation" required>  
                                            </div>
                                            @if ($errors->has('password'))
                                                <span >
                                                    <strong style="color:white; padding-bottom:10px;">{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div align="center" class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <label class="container_check">Mostrar contraseñas
                                                <input type="checkbox" onclick="mostrarPass()">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div align="center" class="form-group">
                                        <a href="https://www.bangoenergygel.com/index.php/terminos-de-servicio/" target="_blank"> Leer Términos y condiciones </a>
                                    </div>

                                    <div align="center" class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <label class="container_check">Confirmo que he leído y aceptado los términos y condiciones de BanGo Energy Gel
                                                <input type="checkbox" id="myCheck" onclick="terminos()">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                        
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center login_container">
                                                <button type="submit" id="myBtn" disabled name="button" class="btn login_btn">Registrarse</button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <div class="d-flex justify-content-center links">
                                            ¿Ya tienes una cuenta? <a style="font-weight: bold;" href="{{url('/')}}" onclick="return myFunction();" class="ml-2">Ingresa aquí</a>
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
                    </div>
                </div>
            </div>
        </div>
        <!--welcome area end-->



 

        <!-- jquery 2.2.4 js-->
        <script src="{{url('frontend/js/jquery-2.2.4.min.js')}}"></script>
        <!-- popper js-->
        <script src="{{url('frontend/js/popper.js')}}"></script>
        <!-- carousel js-->
        <script src="{{url('frontend/js/owl.carousel.min.js')}}"></script>
        <!-- wow js-->
        <script src="{{url('frontend/js/wow.min.js')}}"></script>
        <!-- bootstrap js-->
        <script src="{{url('frontend/js/bootstrap.min.js')}}"></script>
        <!--mobile menu js-->
        <script src="{{url('frontend/js/jquery.slicknav.min.js')}}"></script>
        <!--particle s-->
        <script src="{{url('frontend/js/particles.min.js')}}"></script>
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

        <script type="text/javascript">
            function OnChangeRadio (radio) {
                if(radio.value=="S"){
                    document.getElementById("cod_patrocinador").value = "";
                    $("#cod_patrocinador").removeAttr("readonly");

                }else{
                    document.getElementById("cod_patrocinador").value = "0992760621001";
                    $("#cod_patrocinador").attr("readonly","readonly");
                }
            }
        </script>

        <script>
            function mostrarPass() {
              var x = document.getElementById("password");
              var y = document.getElementById("password-confirm");
              if (x.type === "password" || y.type === "password") {
                x.type = "text";
                y.type = "text";
              } else {
                x.type = "password";
                y.type = "password";
              }
            }
        </script>


        <script>
            function terminos() {
                var checkBox = document.getElementById("myCheck");
                if (checkBox.checked == true){
                    document.getElementById("myBtn").disabled = false;
                } else {
                    document.getElementById("myBtn").disabled = true;
                }
            }
        </script>

    </body>
</html>
