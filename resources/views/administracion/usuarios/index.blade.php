@extends('layouts.administracion')

@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 10px">
        <h4 style="color: black; text-align:center; font-size:25px;">Usuarios Registrados </h4>

    </div>

  
  <div class="container-fluid">

    
                           
        @if (session('mensaje-registro'))
            @include('mensajes.msj_correcto')
        @endif
    <div class="row">
           <div class="col-12	col-sm-12	col-md-12	col-lg-12	col-xl-12" id="tag_container"> 

         @if(count($usuarios) >0)
               @include('usuarios-ajax')
            
               

            
            </div>

     
            @else
                <div class="col-md-12 col-lg-12">
                    <div class="statistic__item">
                        <h2 class="number">Oh no!</h2>
                        <label style='color:#FA206A'>...No se ha encontrado ningún registro...</label>  
                        <div class="icon">
                            <i class="zmdi zmdi-mood-bad"></i>
                        </div>


                        @if(Auth::user()->rol == "Administrador")


                            <div class="col-md-12 col-lg-12" align="center">
                                <a href="{{route('usuarios.create')}}"><button title="Añadir nuevo registro" id="payment-button" type="submit" class="btn btn-lg btn-info">
                                        <i class="fas fa-plus-circle"></i>
                                   
                                    
                                </button>
                                </a>
                            </div>
                        @endif
                    </div>
                   
                </div>
            
            @endif
        </div>

      

       </div>

      {!! Form::open(['route' => ['usuarios.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
        {!! Form::close() !!}
        
       


  

</div>