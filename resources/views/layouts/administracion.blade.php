<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bango Energy Gel">
    <meta name="author" content="U4Innovation">
    <meta name="keywords" content="bots, instagram bots">
    <meta name="csrf_token" content="{ csrf_token() }" />

    <!-- Title Page-->
    <title>Registrados</title>

    <!-- Fontfaces CSS-->
   
    <link rel="stylesheet" href="{{url('registrados/css/font-face.css')}}">
    <link rel="stylesheet" href="{{url('registrados/vendor/font-awesome-4.7/css/font-awesome.min.css')}}">
    
    <link rel="stylesheet" href="{{url('registrados/vendor/font-awesome-5/css/fontawesome-all.min.css')}}">
    
    <link rel="stylesheet" href="{{url('registrados/vendor/mdi-font/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{url('registrados/css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{url('registrados/css/bootstrap-material-design.min.css')}}">

    <!-- Bootstrap CSS-->
    
   
    <link rel="stylesheet" href="{{url('registrados/vendor/bootstrap-4.1/bootstrap.min.css')}}">


    <!-- Vendor CSS-->
    
    <link rel="stylesheet" href="{{url('registrados/vendor/animsition/animsition.min.css')}}">
    
  
    
    <link rel="stylesheet" href="{{url('registrados/vendor/wow/animate.css')}}">
    
    <link rel="stylesheet" href="{{url('registrados/vendor/css-hamburgers/hamburgers.min.css')}}">
    
    <link rel="stylesheet" href="{{url('registrados/vendor/slick/slick.css')}}">
    
    <link rel="stylesheet" href="{{url('registrados/vendor/select2/select2.min.css')}}">
   
    <link rel="stylesheet" href="{{url('registrados/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
  

    <link rel="stylesheet" href="{{url('registrados/css/mensajes.css')}}">
    <link rel="stylesheet" href="{{url('registrados/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{url('registrados/css/blue.css')}}">

    <!-- Main CSS-->
   
    <link rel="stylesheet" href="{{url('registrados/css/theme.css')}}">
    
    <link rel="stylesheet" href="{{url('registrados/vendor/datatables/dataTables.bootstrap.css')}}">




    <link rel="icon" href="{{ asset('frontend/images/icon.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />



    <style type="text/css">
        
        #menu_letras{
            font-size: 13px;
        }


    </style>


</head>

<body >
        <div class="loader"></div>




    <div class="page-wrapper" >
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="{{url('administracion')}}" onclick="return myFunction();">
                        <img class="img_bango" src="{{url('images/logobangowhite.png')}}"   alt="Bango Energy Gel" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1 shadow">
                <div class="account2">
               
                    <div class="image img-cir img-120">            
                               
                            @if(Auth::user()->path!=null)
                           
                            <img src="{{url('images/'.Auth::user()->path)}}" class="user-image" alt="Mi Foto"  />
                       
                    
                            @else
                                
                                    <img src="{{url('images/no-avatar.png')}}" class="user-image" alt="MI Foto" />
                                

                            @endif
                    </div>

                    <a href="{{route('perfil.index')}}" onclick="return myFunction();">
                            <h4 class="name">{!! Auth::user()->nombres !!}</h4>  
                            <h4 class="name">{!! Auth::user()->apellidos !!}</h4></a>

                    </a>
                    <a href="{{ route('perfil.edit',['parameters' => Crypt::encrypt(Auth::user()->id)])}}" onclick="return myFunction();"> <i class="fas fa-user" style="padding-right: 10px"></i>Editar Perfil</a>
                </div>
                <nav class="navbar-sidebar2" style="    padding-bottom: 50px; " >
                    <ul class="list-unstyled navbar__list">
                        
                        <li>
                            <a href="{{url('administracion')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fas fa-home"></i>Inicio</a>
                            
                        </li>
                        
                        @if(Auth::user()->rol == "Abogado")
                        <li>
                            <a href="{{url('/administracion/solicitud/casos')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fas fa-list"></i>Casos</a>
                            
                        </li>
                        @endif

                        @if(Auth::user()->rol == "Administrador")
                        <li class="has-sub">
                            <a class="js-arrow" href="#" id="menu_letras">
                                <i class="fas fa-user"></i>Usuarios
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a id="menu_letras" href="{{route('usuarios.create')}}" onclick="return myFunction();">
                                        <i class="fas fa-file"></i>Agregar</a>
                                </li>
                                <li>
                                    <a id="menu_letras"  href="{{route('usuarios.index')}}" onclick="return myFunction();">
                                        <i class="fas fa-table"></i>Listado</a>
                                </li>
                                
                            </ul>
                        </li>

                        @endif



                        @if(Auth::user()->rol == "Administrador")
                        <li class="has-sub">
                            <a id="menu_letras" class="js-arrow" href="#">
                                    <i class="fas fa-wrench"></i>Departamentos
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="has-sub">
                                    <a href="{{url('administracion/departamento/registrar')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fa fa-file-pdf-o"></i>Registrar</a>
                                </li>
                            </ul>

                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="has-sub">
                                    <a href="{{url('administracion/departamento/listado')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fa fa-list"></i>Listado</a>
                                </li>
                            </ul>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="has-sub">
                                    <a href="{{url('administracion/departamento/abogados')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fas fa-user"></i>Abogados</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        @if(Auth::user()->rol == "Registrado")
                            @if( $saber_tarifa->count() )
                                <li class="has-sub">
                                    <a id="menu_letras" class="js-arrow" href="#">
                                            <i class="fa fa-file"></i>Solicitudes    
                                        <span class="arrow">
                                            <i class="fas fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li class="has-sub">
                                            <a href="{{url('administracion/solicitud/registrar')}}" onclick="return myFunction();" id="menu_letras">
                                            <i class="fa fa-file-pdf-o"></i>Enviar</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endif

                        @if(Auth::user()->rol == "Registrado")
                        <li class="has-sub">
                            <a id="menu_letras" class="js-arrow" href="#">
                                    <i class="fa fa-file"></i>Pago    
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="has-sub">
                                    <a href="{{url('administracion/pago/registrar')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fa fa-file-pdf-o"></i>Registrar</a>
                                </li>
                                <li class="has-sub">
                                    <a href="{{url('administracion/pago/historial')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fa fa-file-pdf-o"></i>Historial</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        
                        @if(Auth::user()->rol == "Administrador")
                        <li class="has-sub">
                            <a class="js-arrow" href="#" id="menu_letras">
                                <i class="fas fa-credit-card"></i>Tarifas
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a id="menu_letras"  href="{{route('tarifa.index')}}" onclick="return myFunction();">
                                        <i class="fas fa-table"></i>Listado</a>
                                </li>
                                
                            </ul>
                        </li>

                        @endif

                        @if(Auth::user()->rol == "Administrador")
                        <li class="has-sub">
                            <a class="js-arrow" href="#" id="menu_letras">
                                <i class="fas fa-folder"></i>Gestion
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a id="menu_letras" href="{{url('administracion/gestionar')}}" onclick="return myFunction();">
                                        <i class="fas fa-file"></i>Casos</a>
                                </li>
                            </ul>
                        </li>

                        @endif

                        @if(Auth::user()->rol == "Administrador")
                        <li class="has-sub">
                            <a class="js-arrow" href="#" id="menu_letras">
                                <i class="far fa-file-alt"></i>Oficios
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a id="menu_letras" href="{{url('administracion/oficio')}}" onclick="return myFunction();">
                                        <i class="fas fa-file"></i>Agregar</a>
                                </li>
                                <li>
                                    <a id="menu_letras"  href="{{route('tarifa.index')}}" onclick="return myFunction();">
                                        <i class="fas fa-table"></i>Listado</a>
                                </li>
                                
                            </ul>
                        </li>

                        @endif

                        @if(Auth::user()->rol == "Administrador")
                        <li>
                            <a href="{{url('administracion/pago/aprobacion')}}" onclick="return myFunction();" id="menu_letras">
                            <i class="fas fa-list"></i>Aprobación Pagos</a>
                        </li>
                        @endif


                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" id="menu_letras"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>

                            <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="{{url('administracion')}}" onclick="return myFunction();">
                                        <img class="img_bango"  src="{{url('images/logobangowhite.png')}}" alt="Bango Energy Gel" />
                                </a>
                            </div>
                            <div class="header-button2">
                             
                                @if(Auth::user()->rol == "Administrador")
                           
                                @endif

                                @if(Auth::user()->rol == "Abogado")
                             
                                @endif

                                @if(Auth::user()->rol == "Registrado")
                                <div class="header-button-item has-noti js-item-menu">
                                    <i class="zmdi zmdi-email"></i>
                                <span class="quantity">{{$total_respuestas_notificacion}}</span>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                        <p>Usted Tiene {{$total_respuestas_notificacion}} notificaciones sin leer</p>
                                        </div>

                                        @if($total_respuestas_notificacion>0)
                                            @foreach($respuestas_notificacion as $notificacion)

                                            <a href="{{ route('notificacion', ['id' => Crypt::encrypt($notificacion->id)]) }}" onclick="return myFunction();">

                                            <div class="notifi__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{url('images/no-avatar.png')}}" alt="{{$notificacion->solicitud->abogado->nombres}} {{$notificacion->solicitud->abogado->apellidos}}" />
                                                </div>
                                                <div class="content">
                                                    <p>{{$notificacion->titulo}}</p>
                                                    <span class="date">{{$notificacion->solicitud->abogado->nombres}} {{$notificacion->solicitud->abogado->apellidos}} , {{$notificacion->fecha}} , {{$notificacion->hora}}</span>
                                                </div>
                                            </div>

                                            </a>


                                            @endforeach

                                        @endif

                                        

                                        <div class="notifi__footer">
                                            <a href="{{ route('all_notificaciones') }}" onclick="return myFunction();">Ver Todas Notificaciones</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{route('perfil.index')}}" onclick="return myFunction();">
                                                <i class="zmdi zmdi-account"></i>Mi Perfil</a>
                                        </div>
                                     

                                       
                                        
                                    </div>
                                    <div class="account-dropdown__body">
                                        
                                        <div class="account-dropdown__item">

                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>

                                                <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="{{url('administracion')}}" onclick="return myFunction();">
                        <img class="img_bango" src="{{url('images/logobangowhite.png')}}" alt="Bango Energy Gel" />
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        
                        <div class="image img-cir img-120">

                            @if(Auth::user()->path!=null)
                           
                                <img src="{{url('images/'.Auth::user()->path)}}" class="user-image" alt="Mi Foto"  />
                           
                        
                            @else
                                
                                    <img src="{{url('images/no-avatar.png')}}" class="user-image" alt="MI Foto"  />
                                
                                
                            @endif
                               
                            
                                
                            
                      
                        </div>
                        <a href="{{route('perfil.index')}}" onclick="return myFunction();">
                                <h4 class="name">{!! Auth::user()->nombres !!}</h4>  
                                <h4 class="name">{!! Auth::user()->apellidos !!}</h4></a>
    
                        </a>
                     
                        <a href="{{ route('perfil.edit',['parameters' => Crypt::encrypt(Auth::user()->id)])}}" onclick="return myFunction();"> <i class="fas fa-user" style="padding-right: 10px"></i>Editar Perfil</a>
                       
                    </div>
                    <nav class="navbar-sidebar2" style="padding-bottom: 50px;">
                        <ul class="list-unstyled navbar__list">
                            
                            <li>
                                <a href="{{url('administracion')}}" onclick="return myFunction();" id="menu_letras">
                                        <i class="fas fa-home"></i>Inicio</a>
                                
                            </li>
                            
                          
    
                            
    
                            <li class="has-sub">
                                <a id="menu_letras" class="js-arrow" href="#">
                                        <i class="fas fa-wrench"></i>Mis herramientas
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>

                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                        <li class="has-sub">
                                            <a id="menu_letras" class="js-arrow" href="#">
                                                    <i class="fa fa-file-pdf-o"></i>Mis banners
                                                <span class="arrow">
                                                    <i class="fas fa-angle-down"></i>
                                                </span>
                                            </a>
                                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                    @if(Auth::user()->rol == "Administrador")
                                                    <li>
                                                        <a id="menu_letras" href="{{route('herramientas.create')}}" onclick="return myFunction();">
                                                            <i class="fas fa-file"></i>Subir banner</a>
                                                    </li>
                                                    @endif
                                                <li>
                                                    <a id="menu_letras" href="{{route('herramientas.index')}}" onclick="return myFunction();">
                                                        <i class="fas fa-table"></i>Ver banners</a>
                                                </li>
                                            
                                            </ul>
                                        </li>
                                
                                      </ul>


                               

                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li class="has-sub">
                                        <a id="menu_letras" class="js-arrow" href="#">
                                                <i class="fa fa-file-pdf-o"></i>Mis documentos
                                            <span class="arrow">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                                @if(Auth::user()->rol == "Administrador")
                                                <li>
                                                    <a id="menu_letras" href="{{route('documentos.create')}}" onclick="return myFunction();">
                                                        <i class="fas fa-file"></i>Subir documento</a>
                                                </li>
                                                @endif
                                            <li>
                                                <a id="menu_letras" href="{{route('documentos.index')}}" onclick="return myFunction();">
                                                    <i class="fa fa-file-pdf-o"></i>Ver documentos</a>
                                            </li>
                                        
                                        </ul>
                                    </li>
                            
                                  </ul>

                               
                            </li>

    
                           
    
    
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="menu_letras"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END HEADER DESKTOP-->

            @if(Auth::user()->rol == "Administrador")

            <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="btn-group-sm d-none" id="mini-fab">
                          <a href="#" onclick="return myFunction();" class="btn btn-info btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="Herramientas" title="Mis herramientas" id="autre">
                            <i class="material-icons">
                                    <svg  style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000" d="M17.498,11.697c-0.453-0.453-0.704-1.055-0.704-1.697c0-0.642,0.251-1.244,0.704-1.697c0.069-0.071,0.15-0.141,0.257-0.22c0.127-0.097,0.181-0.262,0.137-0.417c-0.164-0.558-0.388-1.093-0.662-1.597c-0.075-0.141-0.231-0.22-0.391-0.199c-0.13,0.02-0.238,0.027-0.336,0.027c-1.325,0-2.401-1.076-2.401-2.4c0-0.099,0.008-0.207,0.027-0.336c0.021-0.158-0.059-0.316-0.199-0.391c-0.503-0.274-1.039-0.498-1.597-0.662c-0.154-0.044-0.32,0.01-0.416,0.137c-0.079,0.106-0.148,0.188-0.22,0.257C11.244,2.956,10.643,3.207,10,3.207c-0.642,0-1.244-0.25-1.697-0.704c-0.071-0.069-0.141-0.15-0.22-0.257C7.987,2.119,7.821,2.065,7.667,2.109C7.109,2.275,6.571,2.497,6.07,2.771C5.929,2.846,5.85,3.004,5.871,3.162c0.02,0.129,0.027,0.237,0.027,0.336c0,1.325-1.076,2.4-2.401,2.4c-0.098,0-0.206-0.007-0.335-0.027C3.001,5.851,2.845,5.929,2.77,6.07C2.496,6.572,2.274,7.109,2.108,7.667c-0.044,0.154,0.01,0.32,0.137,0.417c0.106,0.079,0.187,0.148,0.256,0.22c0.938,0.936,0.938,2.458,0,3.394c-0.069,0.072-0.15,0.141-0.256,0.221c-0.127,0.096-0.181,0.262-0.137,0.416c0.166,0.557,0.388,1.096,0.662,1.596c0.075,0.143,0.231,0.221,0.392,0.199c0.129-0.02,0.237-0.027,0.335-0.027c1.325,0,2.401,1.076,2.401,2.402c0,0.098-0.007,0.205-0.027,0.334C5.85,16.996,5.929,17.154,6.07,17.23c0.501,0.273,1.04,0.496,1.597,0.66c0.154,0.047,0.32-0.008,0.417-0.137c0.079-0.105,0.148-0.186,0.22-0.256c0.454-0.453,1.055-0.703,1.697-0.703c0.643,0,1.244,0.25,1.697,0.703c0.071,0.07,0.141,0.15,0.22,0.256c0.073,0.098,0.188,0.152,0.307,0.152c0.036,0,0.073-0.004,0.109-0.016c0.558-0.164,1.096-0.387,1.597-0.66c0.141-0.076,0.22-0.234,0.199-0.393c-0.02-0.129-0.027-0.236-0.027-0.334c0-1.326,1.076-2.402,2.401-2.402c0.098,0,0.206,0.008,0.336,0.027c0.159,0.021,0.315-0.057,0.391-0.199c0.274-0.5,0.496-1.039,0.662-1.596c0.044-0.154-0.01-0.32-0.137-0.416C17.648,11.838,17.567,11.77,17.498,11.697 M16.671,13.334c-0.059-0.002-0.114-0.002-0.168-0.002c-1.749,0-3.173,1.422-3.173,3.172c0,0.053,0.002,0.109,0.004,0.166c-0.312,0.158-0.64,0.295-0.976,0.406c-0.039-0.045-0.077-0.086-0.115-0.123c-0.601-0.6-1.396-0.93-2.243-0.93s-1.643,0.33-2.243,0.93c-0.039,0.037-0.077,0.078-0.116,0.123c-0.336-0.111-0.664-0.248-0.976-0.406c0.002-0.057,0.004-0.113,0.004-0.166c0-1.75-1.423-3.172-3.172-3.172c-0.054,0-0.11,0-0.168,0.002c-0.158-0.312-0.293-0.639-0.405-0.975c0.044-0.039,0.085-0.078,0.124-0.115c1.236-1.236,1.236-3.25,0-4.486C3.009,7.719,2.969,7.68,2.924,7.642c0.112-0.336,0.247-0.664,0.405-0.976C3.387,6.668,3.443,6.67,3.497,6.67c1.75,0,3.172-1.423,3.172-3.172c0-0.054-0.002-0.11-0.004-0.168c0.312-0.158,0.64-0.293,0.976-0.405C7.68,2.969,7.719,3.01,7.757,3.048c0.6,0.6,1.396,0.93,2.243,0.93s1.643-0.33,2.243-0.93c0.038-0.039,0.076-0.079,0.115-0.123c0.336,0.112,0.663,0.247,0.976,0.405c-0.002,0.058-0.004,0.114-0.004,0.168c0,1.749,1.424,3.172,3.173,3.172c0.054,0,0.109-0.002,0.168-0.004c0.158,0.312,0.293,0.64,0.405,0.976c-0.045,0.038-0.086,0.077-0.124,0.116c-0.6,0.6-0.93,1.396-0.93,2.242c0,0.847,0.33,1.645,0.93,2.244c0.038,0.037,0.079,0.076,0.124,0.115C16.964,12.695,16.829,13.021,16.671,13.334 M10,5.417c-2.528,0-4.584,2.056-4.584,4.583c0,2.529,2.056,4.584,4.584,4.584s4.584-2.055,4.584-4.584C14.584,7.472,12.528,5.417,10,5.417 M10,13.812c-2.102,0-3.812-1.709-3.812-3.812c0-2.102,1.71-3.812,3.812-3.812c2.102,0,3.812,1.71,3.812,3.812C13.812,12.104,12.102,13.812,10,13.812"></path>
                                        </svg>
                           
                            </i>
                          </a>
                          <a href="#" onclick="return myFunction();" class="btn btn-warning btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="SMS" title="Mi Red" id="sms">
                            <i class="material-icons">
    
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000"  d="M14.68,12.621c-0.9,0-1.702,0.43-2.216,1.09l-4.549-2.637c0.284-0.691,0.284-1.457,0-2.146l4.549-2.638c0.514,0.661,1.315,1.09,2.216,1.09c1.549,0,2.809-1.26,2.809-2.808c0-1.548-1.26-2.809-2.809-2.809c-1.548,0-2.808,1.26-2.808,2.809c0,0.38,0.076,0.741,0.214,1.073l-4.55,2.638c-0.515-0.661-1.316-1.09-2.217-1.09c-1.548,0-2.808,1.26-2.808,2.809s1.26,2.808,2.808,2.808c0.9,0,1.702-0.43,2.217-1.09l4.55,2.637c-0.138,0.332-0.214,0.693-0.214,1.074c0,1.549,1.26,2.809,2.808,2.809c1.549,0,2.809-1.26,2.809-2.809S16.229,12.621,14.68,12.621M14.68,2.512c1.136,0,2.06,0.923,2.06,2.06S15.815,6.63,14.68,6.63s-2.059-0.923-2.059-2.059S13.544,2.512,14.68,2.512M5.319,12.061c-1.136,0-2.06-0.924-2.06-2.06s0.923-2.059,2.06-2.059c1.135,0,2.06,0.923,2.06,2.059S6.454,12.061,5.319,12.061M14.68,17.488c-1.136,0-2.059-0.922-2.059-2.059s0.923-2.061,2.059-2.061s2.06,0.924,2.06,2.061S15.815,17.488,14.68,17.488"></path>
                                        </svg>
    
                            </i>
                          </a>
                          <a href="#" onclick="return myFunction();" class="btn btn-danger btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="Mail" title="Invita Genta a Bango" id="mail">
                            <i class="material-icons">
                                    <svg tyle="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000" d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
                                        </svg>
                            </i>
                          </a>
                        </div>
                        <div class="btn-group">
                          <a href="javascript:void(0)" style="z-index: 100;" data-container="body" data-toggle="tooltip" data-placement="left"  class="btn btn-success btn-fab" data-original-title="Opciones" title="Opciones" id="main">
                            <i class="material-icons">
                              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="white" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                              </svg>
                            </i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


            @endif


            @if(Auth::user()->rol == "Abogado")

            <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="btn-group-sm d-none" id="mini-fab">
                          <a href="#" onclick="return myFunction();" class="btn btn-info btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="Herramientas" title="Mis herramientas" id="autre">
                            <i class="material-icons">
                                    <svg  style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000" d="M17.498,11.697c-0.453-0.453-0.704-1.055-0.704-1.697c0-0.642,0.251-1.244,0.704-1.697c0.069-0.071,0.15-0.141,0.257-0.22c0.127-0.097,0.181-0.262,0.137-0.417c-0.164-0.558-0.388-1.093-0.662-1.597c-0.075-0.141-0.231-0.22-0.391-0.199c-0.13,0.02-0.238,0.027-0.336,0.027c-1.325,0-2.401-1.076-2.401-2.4c0-0.099,0.008-0.207,0.027-0.336c0.021-0.158-0.059-0.316-0.199-0.391c-0.503-0.274-1.039-0.498-1.597-0.662c-0.154-0.044-0.32,0.01-0.416,0.137c-0.079,0.106-0.148,0.188-0.22,0.257C11.244,2.956,10.643,3.207,10,3.207c-0.642,0-1.244-0.25-1.697-0.704c-0.071-0.069-0.141-0.15-0.22-0.257C7.987,2.119,7.821,2.065,7.667,2.109C7.109,2.275,6.571,2.497,6.07,2.771C5.929,2.846,5.85,3.004,5.871,3.162c0.02,0.129,0.027,0.237,0.027,0.336c0,1.325-1.076,2.4-2.401,2.4c-0.098,0-0.206-0.007-0.335-0.027C3.001,5.851,2.845,5.929,2.77,6.07C2.496,6.572,2.274,7.109,2.108,7.667c-0.044,0.154,0.01,0.32,0.137,0.417c0.106,0.079,0.187,0.148,0.256,0.22c0.938,0.936,0.938,2.458,0,3.394c-0.069,0.072-0.15,0.141-0.256,0.221c-0.127,0.096-0.181,0.262-0.137,0.416c0.166,0.557,0.388,1.096,0.662,1.596c0.075,0.143,0.231,0.221,0.392,0.199c0.129-0.02,0.237-0.027,0.335-0.027c1.325,0,2.401,1.076,2.401,2.402c0,0.098-0.007,0.205-0.027,0.334C5.85,16.996,5.929,17.154,6.07,17.23c0.501,0.273,1.04,0.496,1.597,0.66c0.154,0.047,0.32-0.008,0.417-0.137c0.079-0.105,0.148-0.186,0.22-0.256c0.454-0.453,1.055-0.703,1.697-0.703c0.643,0,1.244,0.25,1.697,0.703c0.071,0.07,0.141,0.15,0.22,0.256c0.073,0.098,0.188,0.152,0.307,0.152c0.036,0,0.073-0.004,0.109-0.016c0.558-0.164,1.096-0.387,1.597-0.66c0.141-0.076,0.22-0.234,0.199-0.393c-0.02-0.129-0.027-0.236-0.027-0.334c0-1.326,1.076-2.402,2.401-2.402c0.098,0,0.206,0.008,0.336,0.027c0.159,0.021,0.315-0.057,0.391-0.199c0.274-0.5,0.496-1.039,0.662-1.596c0.044-0.154-0.01-0.32-0.137-0.416C17.648,11.838,17.567,11.77,17.498,11.697 M16.671,13.334c-0.059-0.002-0.114-0.002-0.168-0.002c-1.749,0-3.173,1.422-3.173,3.172c0,0.053,0.002,0.109,0.004,0.166c-0.312,0.158-0.64,0.295-0.976,0.406c-0.039-0.045-0.077-0.086-0.115-0.123c-0.601-0.6-1.396-0.93-2.243-0.93s-1.643,0.33-2.243,0.93c-0.039,0.037-0.077,0.078-0.116,0.123c-0.336-0.111-0.664-0.248-0.976-0.406c0.002-0.057,0.004-0.113,0.004-0.166c0-1.75-1.423-3.172-3.172-3.172c-0.054,0-0.11,0-0.168,0.002c-0.158-0.312-0.293-0.639-0.405-0.975c0.044-0.039,0.085-0.078,0.124-0.115c1.236-1.236,1.236-3.25,0-4.486C3.009,7.719,2.969,7.68,2.924,7.642c0.112-0.336,0.247-0.664,0.405-0.976C3.387,6.668,3.443,6.67,3.497,6.67c1.75,0,3.172-1.423,3.172-3.172c0-0.054-0.002-0.11-0.004-0.168c0.312-0.158,0.64-0.293,0.976-0.405C7.68,2.969,7.719,3.01,7.757,3.048c0.6,0.6,1.396,0.93,2.243,0.93s1.643-0.33,2.243-0.93c0.038-0.039,0.076-0.079,0.115-0.123c0.336,0.112,0.663,0.247,0.976,0.405c-0.002,0.058-0.004,0.114-0.004,0.168c0,1.749,1.424,3.172,3.173,3.172c0.054,0,0.109-0.002,0.168-0.004c0.158,0.312,0.293,0.64,0.405,0.976c-0.045,0.038-0.086,0.077-0.124,0.116c-0.6,0.6-0.93,1.396-0.93,2.242c0,0.847,0.33,1.645,0.93,2.244c0.038,0.037,0.079,0.076,0.124,0.115C16.964,12.695,16.829,13.021,16.671,13.334 M10,5.417c-2.528,0-4.584,2.056-4.584,4.583c0,2.529,2.056,4.584,4.584,4.584s4.584-2.055,4.584-4.584C14.584,7.472,12.528,5.417,10,5.417 M10,13.812c-2.102,0-3.812-1.709-3.812-3.812c0-2.102,1.71-3.812,3.812-3.812c2.102,0,3.812,1.71,3.812,3.812C13.812,12.104,12.102,13.812,10,13.812"></path>
                                        </svg>
                           
                            </i>
                          </a>
                          <a href="#" onclick="return myFunction();" class="btn btn-warning btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="SMS" title="Mi Red" id="sms">
                            <i class="material-icons">
    
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000"  d="M14.68,12.621c-0.9,0-1.702,0.43-2.216,1.09l-4.549-2.637c0.284-0.691,0.284-1.457,0-2.146l4.549-2.638c0.514,0.661,1.315,1.09,2.216,1.09c1.549,0,2.809-1.26,2.809-2.808c0-1.548-1.26-2.809-2.809-2.809c-1.548,0-2.808,1.26-2.808,2.809c0,0.38,0.076,0.741,0.214,1.073l-4.55,2.638c-0.515-0.661-1.316-1.09-2.217-1.09c-1.548,0-2.808,1.26-2.808,2.809s1.26,2.808,2.808,2.808c0.9,0,1.702-0.43,2.217-1.09l4.55,2.637c-0.138,0.332-0.214,0.693-0.214,1.074c0,1.549,1.26,2.809,2.808,2.809c1.549,0,2.809-1.26,2.809-2.809S16.229,12.621,14.68,12.621M14.68,2.512c1.136,0,2.06,0.923,2.06,2.06S15.815,6.63,14.68,6.63s-2.059-0.923-2.059-2.059S13.544,2.512,14.68,2.512M5.319,12.061c-1.136,0-2.06-0.924-2.06-2.06s0.923-2.059,2.06-2.059c1.135,0,2.06,0.923,2.06,2.059S6.454,12.061,5.319,12.061M14.68,17.488c-1.136,0-2.059-0.922-2.059-2.059s0.923-2.061,2.059-2.061s2.06,0.924,2.06,2.061S15.815,17.488,14.68,17.488"></path>
                                        </svg>
    
                            </i>
                          </a>
                          <a href="#" onclick="return myFunction();" class="btn btn-danger btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="Mail" title="Invita Genta a Bango" id="mail">
                            <i class="material-icons">
                                    <svg tyle="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000" d="M15.573,11.624c0.568-0.478,0.947-1.219,0.947-2.019c0-1.37-1.108-2.569-2.371-2.569s-2.371,1.2-2.371,2.569c0,0.8,0.379,1.542,0.946,2.019c-0.253,0.089-0.496,0.2-0.728,0.332c-0.743-0.898-1.745-1.573-2.891-1.911c0.877-0.61,1.486-1.666,1.486-2.812c0-1.79-1.479-3.359-3.162-3.359S4.269,5.443,4.269,7.233c0,1.146,0.608,2.202,1.486,2.812c-2.454,0.725-4.252,2.998-4.252,5.685c0,0.218,0.178,0.396,0.395,0.396h16.203c0.218,0,0.396-0.178,0.396-0.396C18.497,13.831,17.273,12.216,15.573,11.624 M12.568,9.605c0-0.822,0.689-1.779,1.581-1.779s1.58,0.957,1.58,1.779s-0.688,1.779-1.58,1.779S12.568,10.427,12.568,9.605 M5.06,7.233c0-1.213,1.014-2.569,2.371-2.569c1.358,0,2.371,1.355,2.371,2.569S8.789,9.802,7.431,9.802C6.073,9.802,5.06,8.447,5.06,7.233 M2.309,15.335c0.202-2.649,2.423-4.742,5.122-4.742s4.921,2.093,5.122,4.742H2.309z M13.346,15.335c-0.067-0.997-0.382-1.928-0.882-2.732c0.502-0.271,1.075-0.429,1.686-0.429c1.828,0,3.338,1.385,3.535,3.161H13.346z"></path>
                                        </svg>
                            </i>
                          </a>
                        </div>
                        <div class="btn-group">
                          <a href="javascript:void(0)" style="z-index: 100;" data-container="body" data-toggle="tooltip" data-placement="left"  class="btn btn-success btn-fab" data-original-title="Opciones" title="Opciones" id="main">
                            <i class="material-icons">
                              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="white" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                              </svg>
                            </i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


            @endif

            
            @if(Auth::user()->rol == "Registrado")

            <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        
                        <div class="btn-group">
                          <a onclick="return myFunction();"  href="{{url('administracion/solicitud/registrar')}}" style="z-index: 100;" data-container="body" data-toggle="tooltip" data-placement="left"  class="btn btn-success btn-fab" data-original-title="Redactar solicitud" title="Redactar solicitud" id="main">
                            <i class="material-icons">
                              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="white" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                              </svg>
                            </i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>


            @endif

            

      

            

           
            <section class="top" id="main2">

               
                  
              

                    @yield('contenido')

            </section>

            

            

            


            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{url('registrados/vendor/jquery-3.2.1.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    
    <!-- Bootstrap JS-->
    <script src="{{url('registrados/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{url('registrados/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>

    <script src='https://cdn.jsdelivr.net/g/bootstrap.material-design@0.5.9(js/material.min.js+js/ripples.min.js)'></script>
    
    <!-- Vendor JS       -->
    <script src="{{url('registrados/vendor/slick/slick.min.js')}}"></script>
    <script src="{{url('registrados/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('registrados/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>


    <script src="{{url('registrados/vendor/wow/wow.min.js')}}"></script>
    <script src="{{url('registrados/vendor/animsition/animsition.min.js')}}"></script>


    <script src="{{url('registrados/vendor/counter-up/jquery.waypoints.min.js')}}"></script>

    <script src="{{url('registrados/vendor/counter-up/jquery.counterup.min.js')}}"></script>



    <script src="{{url('registrados/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{url('registrados/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{url('registrados/vendor/select2/select2.min.js')}}"></script>


    <!-- Main JS-->
    <script src="{{url('registrados/js/adminlte.min.js')}}"></script>
    <script src="{{url('registrados/js/icheck.min.js')}}"></script>

 
    <script src="{{url('registrados/js/main.js')}}"></script>
    <script src="{{url('registrados/js/sweetalert.min.js')}}"></script>


    <script type="text/javascript">
   
        $(window).on('load', function(){ 
            $(".loader").fadeOut("slow");

        });

        </script>
        

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".aprobado").fadeOut(300);
            },3000);
        });

        function myFunction() {
                $(".loader").show();
           
            }
       
    </script>

<script>
    $(function() {
        $(".select2").select2();
        $(".select3").select2();


    
    });


</script>


<script>

$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
"paging": false,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],

"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});

$('#example3').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,

});
});

$('#example4').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});

$('#example5').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});

$('#example6').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});

$('#example7').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});

$('#example8').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});

$('#example9').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});


$('#example10').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});


$('#example11').DataTable({
"paging": true,
"lengthChange": true,
"searching": true,
"ordering": false,
"info": false,
"autoWidth": false,
"aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
"language": {
"search": "Buscar:",
"sLengthMenu":     "Mostrar _MENU_ registros",
"oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },

},
});


</script>




    <script>

$().tooltip({ container: 'body' });

    </script>




    @yield('script')

</body>

</html>
<!-- end document-->