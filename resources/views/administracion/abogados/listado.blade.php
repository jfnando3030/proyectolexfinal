@extends('layouts.administracion')

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

<style type="text/css">
    
    #msj_verified{
        color: white;
        font-size: 12px;
        padding: 7px 15px;
        border-radius: 20px;

    }

</style>

 <script type="text/javascript">
  $(document).ready(function() {
      setTimeout(function() {
          $("#msj_sesion").fadeOut(2000);
      },5000);
  });
</script>
@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Listado de Abogados </h4>
    </div>
  <div class="container-fluid">
   @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif
    @if (session('mensaje-error'))
            @include('mensajes.msj_rechazado')
        @endif
    <div class="row">
        <div class="col-12  col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if( $departamento->count() > 0 ) 
            <div class="row">
                <div class="col-md-6">

                </div>
            
                <div class="col-md-6">
                
                </div>
            </div>
           
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning" id="tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Usuario</th>
                            <th>Nombre del Departamento</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuario as $us)
                            <tr>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$us->id}} </td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$us->nombres}} {{$us->apellidos}}</td>
                                <td style="vertical-align:middle; font-size: 16px;">
                                @foreach ( $departamento as $dep )
                                @if($us->id == $dep->id)
                                {{$dep->nombre_departamento}}<br>
                                @endif
                                @endforeach
                                </td>
                                <td> 
                                    <a href="{{ url('administracion/usuarios') }}/{{ Crypt::encrypt($us->id) }}/edit" id="editar" class="btn btn-sm btn-warning" style="font-weight: bold; color: white;"> Actualizar datos </a>
                                    {{-- <a href="#" id="del-{{ $departamento->id }}" class="btn btn-sm btn-primary">Eliminar</a>
                                    <script>
                                        $("#del-"+{{ $departamento->id }}).click(function(e){
                                            swal({
                                              title: "Atención",
                                              text: "¿Estas seguro de eliminar este departamento?",
                                              type: "warning",
                                              showCancelButton: true,
                                              cancelButtonText: "NO",
                                              confirmButtonClass: "btn-danger",
                                              confirmButtonText: "Sí, deseo eliminar!",
                                              closeOnConfirm: true
                                            },
                                            function(){
                                                window.location="{{ url('/administracion/departamento/eliminar/') }}/{{ Crypt::encrypt($departamento->id) }}";
                                                swal("!Exitoso!", "Departamento ha sido eliminado correctamente.", "success");
                                            });
                                        });
                                    </script> --}}
                                </td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    
                        <a href="http://localhost/proyectolexfinal/administracion/departamento/registrar">
                            <button title="Añadir nuevo registro" id="payment-button" type="submit" class="btn btn-lg btn-info">
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
</div>

@endsection

@section('script')
    <script src="{{url('js/delete.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".aprobado").fadeOut(300);
            },3000);
        });
    </script>

      
@endsection