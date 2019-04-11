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
        <h4 style="color: black; text-align:center; font-size:25px;"> Historial de pagos </h4>
    </div>
  <div class="container-fluid">
   @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif
    <div class="row">
        <div class="col-12  col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if( count($pagos) > 0 ) 
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
                            <th>Usuario</th>
                            <th>Tarifa</th>
                            <th>Monto</th>
                            <th>Inicio</th>
                            <th>Finaliza</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pagos)
                            <tr>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$pagos->nombres}} {{$pagos->apellidos}} </td>
                                @if ($pagos->modo_pago == "P")
                                    <td style="vertical-align:middle; font-size: 16px;"> Paypal </td>
                                @endif
                                @if ($pagos->modo_pago == "DT")
                                    <td style="vertical-align:middle; font-size: 16px;"> Transferencia o deposito </td>
                                @endif
                                @if ($pagos->modo_pago == "Free")
                                    <td style="vertical-align:middle; font-size: 16px;"> Gratuito </td>
                                @endif
                                <td style="vertical-align:middle; font-size: 16px;"> {{$pagos->monto_pago}}</td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$pagos->fecha_inicio}} </td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$pagos->fecha_finalizacion}} </td>
                                <td width="10%">
                                  <center>

                                    @if ($pagos->estado == "0" and $pagos->activo == "0")
                                    <a href="#" id="del-{{ $pagos->id }}" class="btn btn-sm btn-primary"> Aprobar </a>
                                    <script>
                                      $("#del-"+{{ $pagos->id }}).click(function(e){
                                          swal({
                                            title: "Atención",
                                            text: "¿Estas seguro de aprobar el pago?",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonClass: "btn-primary",
                                            confirmButtonText: "Sí, aprobar!",
                                            closeOnConfirm: false
                                          },
                                          function(){
                                              window.location="{{ url('administracion/pagos/aprobar/') }}/{{ $pagos->id }}";
                                              swal("!Eliminado!", "El pago ha sido aprobado correctamente.", "success");
                                          });
                                      });
                                      </script>
                                      @endif

                                      @if ($pagos->estado == "1" and $pagos->activo == "1")
                                      <a href="#" id="cancelar-{{ $pagos->id }}" class="btn btn-sm btn-primary" style="background-color: red; border-color: red;"> Cancelar </a>
                                        <script>
                                      $("#cancelar-"+{{ $pagos->id }}).click(function(e){
                                          swal({
                                            title: "Atención",
                                            text: "¿Estas seguro de aprobar el pago?",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonClass: "btn-primary",
                                            confirmButtonText: "Sí, aprobar!",
                                            closeOnConfirm: false
                                          },
                                          function(){
                                              window.location="{{ url('administracion/pagos/cancelar/') }}/{{ $pagos->id }}";
                                              swal("!Eliminado!", "El pago ha sido cancelado correctamente.", "success");
                                          });
                                      });
                                      </script>
                                      @endif
                                      @if ($pagos->estado == "0" and $pagos->activo == "2")
                                       FINALIZADO 
                                      @endif
                                  </center>
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