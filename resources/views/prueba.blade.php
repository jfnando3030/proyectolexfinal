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

                                <div class="row">
                                    
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">

                                    	<table width="560" border="0" cellspacing="2" cellpadding="0">
											<tr>
												<td valign="top"><p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">&iexcl;Hola!<br><br> te ha invitado para que te unas a Bango Energy Gel.</p> 
									 				<p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; text-align:justify">Haz clic en este v&iacute;nculo para que te inscribas:<br>
									 					<a href="#" title="Invita a tus amigos" target="_blank" style="border:medium; font-family:Verdana, Geneva, sans-serif; font-size:12px;"> Prueba </a>
									 				</p>
									 			</td>
											</tr>
										</table>
                                    	
                                    </div>

                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                        
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
   
    $(window).on('load', function(){ 
        $(".loader").fadeOut("slow");

    });

    function myFunction() {
            $(".loader").show();
       
        }

    </script>


</html>
