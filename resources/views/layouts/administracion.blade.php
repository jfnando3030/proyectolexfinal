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

                        @if(Auth::user()->rol == "Administrador" or Auth::user()->rol == "Secretaria")
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



                        @if(Auth::user()->rol == "Administrador" or Auth::user()->rol == "Secretaria")
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
                        
                        @if(Auth::user()->rol == "Administrador" or Auth::user()->rol == "Secretaria")
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

                        @if(Auth::user()->rol == "Administrador" )
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

                        @if(Auth::user()->rol == "Administrador" or Auth::user()->rol == "Abogado")
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
                                    <a id="menu_letras"  href="{{url('administracion/oficios')}}" onclick="return myFunction();">
                                        <i class="fas fa-table"></i>Listado</a>
                                </li>
                                
                            </ul>
                        </li>

                        @endif


                        @if(Auth::user()->rol == "Administrador")
                        <li>
                            <a href="{{url('administracion/ver_logs')}}" onclick="return myFunction();" id="menu_letras">
                            <i class="fas fa-eye"></i>Ver logs</a>
                        </li>
                        @endif


                        @if(Auth::user()->rol == "Administrador")
                        <li>
                            <a href="{{url('administracion/pago/aprobacion')}}" onclick="return myFunction();" id="menu_letras">
                            <i class="fas fa-list"></i>Aprobación Pagos</a>
                        </li>
                        @endif
                        @if(Auth::user()->rol == "Abogado" or  Auth::user()->rol == "Registrado" )

                        <li class="has-sub">
                            <a class="js-arrow" href="#" id="menu_letras">
                                <i class="far fa-file-alt"></i>Visitas
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a id="menu_letras" href="{{url('administracion/visita')}}" onclick="return myFunction();">
                                        <i class="fas fa-file"></i>Generar Visita</a>
                                </li>
                                <li>
                                    <a id="menu_letras"  href="{{url('administracion/respuestas_visitas')}}" onclick="return myFunction();">
                                        <i class="fas fa-table"></i>Respuestas</a>
                                </li>
                                
                            </ul>
                        </li>


 
                        @endif


                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" id="menu_letras"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>

                            <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}
                                    <input type="hidden" name="ip_valor5" value="" id="ip_valor5">
                                    <input type="hidden" name="navegador5" value="" id="navegador5">
                            </form>
                            
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

                                                <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}
                                                        <input type="hidden" name="ip_valor6" value="" id="ip_valor6">
                                                        <input type="hidden" name="navegador6" value="" id="navegador6">
                                                
                                                </form>
                                           
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
                            

                            @if(Auth::user()->rol == "Abogado")
                        <li>
                            <a href="{{url('/administracion/solicitud/casos')}}" onclick="return myFunction();" id="menu_letras">
                                    <i class="fas fa-list"></i>Casos</a>
                            
                        </li>
                        @endif

                        @if(Auth::user()->rol == "Administrador"  or Auth::user()->rol == "Secretaria")
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



                        @if(Auth::user()->rol == "Administrador"  or Auth::user()->rol == "Secretaria")
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
                        
                        @if(Auth::user()->rol == "Administrador"  or Auth::user()->rol == "Secretaria")
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

                        @if(Auth::user()->rol == "Administrador" or Auth::user()->rol == "Abogado")
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
                                    <a id="menu_letras"  href="{{url('administracion/oficios')}}" onclick="return myFunction();">
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

                        @if(Auth::user()->rol == "Administrador")
                        <li>
                            <a href="{{url('administracion/ver_logs')}}" onclick="return myFunction();" id="menu_letras">
                            <i class="fas fa-eye"></i>Ver logs</a>
                        </li>
                        @endif
                          
    
                            
    

    
                           
    
    
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="menu_letras"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}
                                        <input type="hidden" name="ip_valor7" value="" id="ip_valor7">
                                        <input type="hidden" name="navegador7" value="" id="navegador7">
                                </form>
                                
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
                          <a href="{{url('administracion/pago/aprobacion')}}" onclick="return myFunction();" class="btn btn-info btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="Herramientas" title="Aprobar pagos" id="autre">
                            <i class="material-icons">
                                    <svg  style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000" d="M5.229,6.531H4.362c-0.239,0-0.434,0.193-0.434,0.434c0,0.239,0.194,0.434,0.434,0.434h0.868c0.24,0,0.434-0.194,0.434-0.434C5.663,6.724,5.469,6.531,5.229,6.531 M10,6.531c-1.916,0-3.47,1.554-3.47,3.47c0,1.916,1.554,3.47,3.47,3.47c1.916,0,3.47-1.555,3.47-3.47C13.47,8.084,11.916,6.531,10,6.531 M11.4,11.447c-0.071,0.164-0.169,0.299-0.294,0.406c-0.124,0.109-0.27,0.191-0.437,0.248c-0.167,0.057-0.298,0.09-0.492,0.098v0.402h-0.35v-0.402c-0.21-0.004-0.352-0.039-0.527-0.1c-0.175-0.064-0.324-0.154-0.449-0.27c-0.124-0.115-0.221-0.258-0.288-0.428c-0.068-0.17-0.1-0.363-0.096-0.583h0.664c-0.004,0.259,0.052,0.464,0.169,0.613c0.116,0.15,0.259,0.229,0.527,0.236v-1.427c-0.159-0.043-0.268-0.095-0.425-0.156c-0.157-0.061-0.299-0.139-0.425-0.235C8.852,9.752,8.75,9.631,8.672,9.486C8.594,9.34,8.556,9.16,8.556,8.944c0-0.189,0.036-0.355,0.108-0.498c0.072-0.144,0.169-0.264,0.292-0.36c0.122-0.097,0.263-0.17,0.422-0.221c0.159-0.052,0.277-0.077,0.451-0.077V7.401h0.35v0.387c0.174,0,0.29,0.023,0.445,0.071c0.155,0.047,0.29,0.118,0.404,0.212c0.115,0.095,0.206,0.215,0.274,0.359c0.067,0.146,0.103,0.315,0.103,0.508H10.74c-0.007-0.201-0.06-0.354-0.154-0.46c-0.096-0.106-0.199-0.159-0.408-0.159v1.244c0.174,0.047,0.296,0.102,0.462,0.165c0.167,0.063,0.314,0.144,0.443,0.241c0.128,0.099,0.23,0.221,0.309,0.366c0.077,0.146,0.116,0.324,0.116,0.536C11.509,11.092,11.473,11.283,11.4,11.447 M18.675,4.795H1.326c-0.479,0-0.868,0.389-0.868,0.868v8.674c0,0.479,0.389,0.867,0.868,0.867h17.349c0.479,0,0.867-0.389,0.867-0.867V5.664C19.542,5.184,19.153,4.795,18.675,4.795M1.76,5.664c0.24,0,0.434,0.193,0.434,0.434C2.193,6.336,2,6.531,1.76,6.531S1.326,6.336,1.326,6.097C1.326,5.857,1.52,5.664,1.76,5.664 M1.76,14.338c-0.24,0-0.434-0.195-0.434-0.434c0-0.24,0.194-0.434,0.434-0.434s0.434,0.193,0.434,0.434C2.193,14.143,2,14.338,1.76,14.338 M18.241,14.338c-0.24,0-0.435-0.195-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,14.143,18.48,14.338,18.241,14.338 M18.675,12.682c-0.137-0.049-0.281-0.08-0.434-0.08c-0.719,0-1.302,0.584-1.302,1.303c0,0.152,0.031,0.297,0.08,0.434H2.981c0.048-0.137,0.08-0.281,0.08-0.434c0-0.719-0.583-1.303-1.301-1.303c-0.153,0-0.297,0.031-0.434,0.08V7.318c0.136,0.049,0.28,0.08,0.434,0.08c0.718,0,1.301-0.583,1.301-1.301c0-0.153-0.032-0.298-0.08-0.434H17.02c-0.049,0.136-0.08,0.28-0.08,0.434c0,0.718,0.583,1.301,1.302,1.301c0.152,0,0.297-0.031,0.434-0.08V12.682z M18.241,6.531c-0.24,0-0.435-0.194-0.435-0.434c0-0.24,0.194-0.434,0.435-0.434c0.239,0,0.434,0.193,0.434,0.434C18.675,6.336,18.48,6.531,18.241,6.531 M9.22,8.896c0,0.095,0.019,0.175,0.058,0.242c0.039,0.066,0.088,0.124,0.148,0.171c0.061,0.047,0.13,0.086,0.21,0.115c0.079,0.028,0.11,0.055,0.192,0.073V8.319c-0.21,0-0.322,0.044-0.437,0.132C9.277,8.54,9.22,8.688,9.22,8.896 M15.639,12.602h-0.868c-0.239,0-0.434,0.195-0.434,0.434c0,0.24,0.194,0.436,0.434,0.436h0.868c0.24,0,0.434-0.195,0.434-0.436C16.072,12.797,15.879,12.602,15.639,12.602 M10.621,10.5c-0.068-0.052-0.145-0.093-0.23-0.124c-0.086-0.031-0.123-0.06-0.212-0.082v1.374c0.209-0.016,0.332-0.076,0.465-0.186c0.134-0.107,0.201-0.281,0.201-0.516c0-0.11-0.02-0.202-0.062-0.277C10.743,10.615,10.688,10.551,10.621,10.5"></path>
                                        </svg>
                           
                            </i>
                          </a>
                          <a href="{{url('administracion/oficio')}}" onclick="return myFunction();" class="btn btn-warning btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="SMS" title="Redactar Oficio" id="sms">
                            <i class="material-icons">
    
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                            <path fill="#000000"  d="M15.475,6.692l-4.084-4.083C11.32,2.538,11.223,2.5,11.125,2.5h-6c-0.413,0-0.75,0.337-0.75,0.75v13.5c0,0.412,0.337,0.75,0.75,0.75h9.75c0.412,0,0.75-0.338,0.75-0.75V6.94C15.609,6.839,15.554,6.771,15.475,6.692 M11.5,3.779l2.843,2.846H11.5V3.779z M14.875,16.75h-9.75V3.25h5.625V7c0,0.206,0.168,0.375,0.375,0.375h3.75V16.75z"></path>
                                        </svg>
    
                            </i>
                          </a>
                          <a href="{{route('usuarios.create')}}" onclick="return myFunction();" class="btn btn-danger btn-fab" data-container="body" data-toggle="tooltip" data-placement="left" data-original-title="Mail" title="Agregar usuario" id="mail">
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
                        
                        <div class="btn-group">
                          <a onclick="return myFunction();"  href="{{url('/administracion/solicitud/casos')}}" style="z-index: 100;" data-container="body" data-toggle="tooltip" data-placement="left"  class="btn btn-success btn-fab" data-original-title="Redactar solicitud" title="Ver casos" id="main">
                            <i class="material-icons">
                              <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="white" d="M17.222,5.041l-4.443-4.414c-0.152-0.151-0.356-0.235-0.571-0.235h-8.86c-0.444,0-0.807,0.361-0.807,0.808v17.602c0,0.448,0.363,0.808,0.807,0.808h13.303c0.448,0,0.808-0.36,0.808-0.808V5.615C17.459,5.399,17.373,5.192,17.222,5.041zM15.843,17.993H4.157V2.007h7.72l3.966,3.942V17.993z" />
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


               var findIP = new Promise(r=>{var w=window,a=new (w.RTCPeerConnection||w.mozRTCPeerConnection||w.webkitRTCPeerConnection)({iceServers:[]}),b=()=>{};a.createDataChannel("");a.createOffer(c=>a.setLocalDescription(c,b,b),b);a.onicecandidate=c=>{try{c.candidate.candidate.match(/([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g).forEach(r)}catch(e){}}})

                findIP.then((ip)=>{
                    
                    if ( document.getElementById( "ip_valor" )) {
                        document.getElementById("ip_valor").value=ip;
                    }

                    if ( document.getElementById( "ip_valor1" )) {
                        document.getElementById("ip_valor1").value=ip;
                    }

                    if ( document.getElementById( "ip_valor2" )) {
                        document.getElementById("ip_valor2").value=ip;
                    }

                    if ( document.getElementById( "ip_valor3" )) {
                        document.getElementById("ip_valor3").value=ip;
                    }

                    if ( document.getElementById( "ip_valor4" )) {
                        document.getElementById("ip_valor4").value=ip;
                    }

                    if ( document.getElementById( "ip_valor5" )) {
                        document.getElementById("ip_valor5").value=ip;
                    }

                    if ( document.getElementById( "ip_valor6" )) {
                        document.getElementById("ip_valor6").value=ip;
                    }

                    if ( document.getElementById( "ip_valor7" )) {
                        document.getElementById("ip_valor7").value=ip;
                    }
                }
                
                ).catch(e => console.error(e));

                if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
                {

                    if ( document.getElementById( "navegador1" )) {
                        document.getElementById("navegador1").value="Opera";
                    }

                    if ( document.getElementById( "navegador" )) {
                        document.getElementById("navegador").value="Opera";
                    }

                    if ( document.getElementById( "navegador2" )) {
                        document.getElementById("navegador2").value="Opera";
                    }

                    if ( document.getElementById( "navegador3" )) {
                        document.getElementById("navegador3").value="Opera";
                    }

                    if ( document.getElementById( "navegador4" )) {
                        document.getElementById("navegador4").value="Opera";
                    }

                    if ( document.getElementById( "navegador5" )) {
                        document.getElementById("navegador5").value="Opera";
                    }

                    if ( document.getElementById( "navegador6" )) {
                        document.getElementById("navegador6").value="Opera";
                    }

                    if ( document.getElementById( "navegador7" )) {
                        document.getElementById("navegador7").value="Opera";
                    }


                }
                else if(navigator.userAgent.indexOf("Chrome") != -1 )
                {

                    if ( document.getElementById( "navegador" )) {
                        document.getElementById("navegador").value="Chrome";
                    }

                    if ( document.getElementById( "navegador1" )) {
                        document.getElementById("navegador1").value="Chrome";
                    }

                    if ( document.getElementById( "navegador2" )) {
                        document.getElementById("navegador2").value="Chrome";
                    }

                    if ( document.getElementById( "navegador3" )) {
                        document.getElementById("navegador3").value="Chrome";
                    }

                    if ( document.getElementById( "navegado4" )) {
                        document.getElementById("navegador4").value="Chrome";
                    }

                    if ( document.getElementById( "navegador5" )) {
                        document.getElementById("navegador5").value="Chrome";
                    }

                    if ( document.getElementById( "navegador6" )) {
                        document.getElementById("navegador6").value="Chrome";
                    }

                    if ( document.getElementById( "navegador7" )) {
                        document.getElementById("navegador7").value="Chrome";
                    }
               
                }
                else if(navigator.userAgent.indexOf("Safari") != -1)
                {

                    if ( document.getElementById( "navegador" )) {
                        document.getElementById("navegador").value="Safari";
                    }

                    if ( document.getElementById( "navegador1" )) {
                        document.getElementById("navegador1").value="Safari";
                    }

                    if ( document.getElementById( "navegador2" )) {
                        document.getElementById("navegador2").value="Safari";
                    }

                    if ( document.getElementById( "navegador3" )) {
                        document.getElementById("navegador3").value="Safari";
                    }

                    if ( document.getElementById( "navegador4" )) {
                        document.getElementById("navegador4").value="Safari";
                    }

                    if ( document.getElementById( "navegador5" )) {
                        document.getElementById("navegador5").value="Safari";
                    }

                    if ( document.getElementById( "navegador6" )) {
                        document.getElementById("navegador6").value="Safari";
                    }

                    if ( document.getElementById( "navegador7" )) {
                        document.getElementById("navegador7").value="Safari";
                    }


              
                }
                else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
                {

                    if ( document.getElementById( "navegador" )) {
                        document.getElementById("navegador").value="Firefox";
                    }

                    if ( document.getElementById( "navegador1" )) {
                        document.getElementById("navegador1").value="Firefox";
                    }
                    if ( document.getElementById( "navegador2" )) {
                        document.getElementById("navegador2").value="Firefox";
                    }
                    if ( document.getElementById( "navegador3" )) {
                        document.getElementById("navegador3").value="Firefox";
                    }
                    if ( document.getElementById( "navegador4" )) {
                        document.getElementById("navegador4").value="Firefox";
                    }


                    if ( document.getElementById( "navegador5" )) {
                        document.getElementById("navegador5").value="Firefox";
                    }


                    if ( document.getElementById( "navegador6" )) {
                        document.getElementById("navegador6").value="Firefox";
                    }

                    if ( document.getElementById( "navegador7" )) {
                        document.getElementById("navegador7").value="Firefox";
                    }

                }
                else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
                {

                    if ( document.getElementById( "navegador" )) {
                        document.getElementById("navegador").value="Internet Explore";
                    }

                    if ( document.getElementById( "navegador1" )) {
                        document.getElementById("navegador1").value="Internet Explore";
                    }
                    if ( document.getElementById( "navegador2" )) {
                        document.getElementById("navegador2").value="Internet Explore";
                    }
                    if ( document.getElementById( "navegador3" )) {
                        document.getElementById("navegador3").value="Internet Explore";
                    }
                    if ( document.getElementById( "navegador4" )) {
                        document.getElementById("navegador4").value="Internet Explore";
                    }

                    if ( document.getElementById( "navegador5" )) {
                        document.getElementById("navegador5").value="Internet Explore";
                    }

                    if ( document.getElementById( "navegador6" )) {
                        document.getElementById("navegador6").value="Internet Explore";
                    }

                    if ( document.getElementById( "navegador7" )) {
                        document.getElementById("navegador7").value="Internet Explore";
                    }

               

                }  

                else if (window.navigator.userAgent.indexOf("Edge") > -1)
                {

                    if ( document.getElementById( "navegador" )) {
                        document.getElementById("navegador").value="Microsoft Edge";
                    }

                    if ( document.getElementById( "navegador1" )) {
                        document.getElementById("navegador1").value="Microsoft Edge";
                    }
                    if ( document.getElementById( "navegador2" )) {
                        document.getElementById("navegador2").value="Microsoft Edge";
                    }
                    if ( document.getElementById( "navegador3" )) {
                        document.getElementById("navegador3").value="Microsoft Edge";
                    }
                    if ( document.getElementById( "navegador4" )) {
                        document.getElementById("navegador4").value="Microsoft Edge";
                    }

                    if ( document.getElementById( "navegador5" )) {
                        document.getElementById("navegador5").value="Microsoft Edge";
                    }

                    if ( document.getElementById( "navegador6" )) {
                        document.getElementById("navegador6").value="Microsoft Edge";
                    }

                    if ( document.getElementById( "navegador7" )) {
                        document.getElementById("navegador7").value="Microsoft Edge";
                    }


                

                }

                else 
                {
                    if ( document.getElementById( "navegador" )) {
                        document.getElementById("navegador").value="Desconocido";
                    }
                    if ( document.getElementById( "navegador1" )) {
                        document.getElementById("navegador1").value="Desconocido";
                    }
                    if ( document.getElementById( "navegador2" )) {
                        document.getElementById("navegador2").value="Desconocido";
                    }
                    if ( document.getElementById( "navegador3" )) {
                        document.getElementById("navegador3").value="Desconocido";
                    }
                    if ( document.getElementById( "navegador4" )) {
                        document.getElementById("navegador4").value="Desconocido";
                    }

                    if ( document.getElementById( "navegador5" )) {
                        document.getElementById("navegador5").value="Desconocido";
                    }


                    if ( document.getElementById( "navegador6" )) {
                        document.getElementById("navegador6").value="Desconocido";
                    }


                    if ( document.getElementById( "navegador7" )) {
                        document.getElementById("navegador7").value="Desconocido";
                    }


               
             
                }

                
               



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