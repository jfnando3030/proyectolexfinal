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
        <h4 style="color: black; text-align:center; font-size:25px;"> Gestion de visitas </h4>
    </div>
  <div class="container-fluid">
   @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif
    <div class="row">
        <div class="col-12  col-sm-12 col-md-12 col-lg-12 col-xl-12">
         @if(auth()->user()->rol == "Registrado")
            @if( $saber_tarifa->count() > 0  ) 

           
            @if( $casos->count() > 0  ) 
           
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning" id="tabla">
                    <thead>
                        <tr>
                            <th>Nombre del caso</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($casos as $casos)
                            <tr>
                               
                                <td style="vertical-align:middle; font-size: 16px;"> {{$casos->nombre_solicitud}}</td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$casos->fecha_solicitud}} </td>
                                @if( $casos->visita == 0  ) 
                                <td width="10%">
                                  <center>  
                                    <a href="#" id="visita-{{ $casos->id }}" class="btn btn-sm btn-primary" style="background-color: #06379d; border-color: #06379d;"> Solicitar visita </a>
                                    <script>
                                    $("#visita-"+{{ $casos->id }}).click(function(e){
                                        swal({
                                          title: "Atención",
                                          text: "¿Estas seguro de Solicitar visita?",
                                          type: "warning",
                                          showCancelButton: true,
                                          confirmButtonClass: "btn-primary",
                                          confirmButtonText: "Sí, Solicitar!",
                                          closeOnConfirm: false
                                        },
                                        function(){
                                            window.location="{{ url('administracion/visita/') }}/{{ $casos->id }}";
                                            swal("Éxito", "Se ha registrado correctamente la visita.", "success");
                                        });
                                    });
                                    </script>
                                  </center>
                                </td>
                                @else 

                                <td style="vertical-align:middle; font-size: 16px;">

                                <p> ya solicito una visita para este caso</p>

                                </td>


                                @endif
                                
                           </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else 

            <div class="col-md-12 col-lg-12">
                    <div class="statistic__item">
                        <h2 class="number">Oh no!</h2>
                        <label style='color:#FA206A'>...No se ha encontrado ningún caso activo...</label>  
                        <div class="icon">
                            <i class="zmdi zmdi-mood-bad"></i>
                        </div>
                    </div>
                </div>


                @endif



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
         
            @else
              @if(auth()->user()->rol == "Abogado")
              @if($solicitud->count() > 0)
             
              <div class="table-responsive table--no-card m-b-30">
                  <table class="table table-borderless table-striped table-earning" id="tabla">
                      <thead>
                          <tr>
                              <th>Nombre del caso</th>
                              <th>Fecha</th>
                              <th>Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($casos as $casos)
                              <tr>
                                 
                                  <td style="vertical-align:middle; font-size: 16px;"> {{$casos->nombre_solicitud}}</td>
                                  <td style="vertical-align:middle; font-size: 16px;"> {{$casos->fecha_solicitud}} </td>
                                  @if( $casos->visita_respuesta == 0  ) 
                                  <td width="10%">
                                       
                                    <center>  
                                      <a href="{{url('administracion/visitas/registrar/'.Crypt::encrypt($casos->id))}}"  class="btn btn-sm btn-primary" style="background-color: #06379d; border-color: #06379d;"> Responder </a>
        
                                    </center>
                                  </td>
                                  @else 
                                  <td style="vertical-align:middle; font-size: 16px;">

                                        <p> ya pacto una visita a este caso</p>
        
                                        </td>
                                  @endif
                                  
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