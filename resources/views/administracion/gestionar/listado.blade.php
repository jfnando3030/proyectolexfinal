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
        <h4 style="color: black; text-align:center; font-size:25px;"> Listado de solicitudes </h4>
    </div>
  <div class="container-fluid">
   @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif
    <div class="row">
        <div class="col-12  col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if( $solicitud->count() > 0 ) 
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
                            <th>Caso</th>
                            <th>Detalle</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitud as $solicitud)
                            <tr>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$solicitud->nombre_solicitud}} </td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$solicitud->descripcion}}</td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$solicitud->fecha_solicitud}} </td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$solicitud->hora_solicitud}} </td>

                                <td> 
                                    <a href="{{ url('/administracion/gestionar/casos/cambiar/') }}/{{ Crypt::encrypt($solicitud->id) }}" id="editar" class="btn btn-sm btn-warning"> Actualizar  abogado </a>
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
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{url('administration/dist/js/roles/delete.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".aprobado").fadeOut(300);
            },3000);
        });
    </script>

      
@endsection