@extends('layouts.administracion')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#niveles_afiliado').change(function(e) {
            $("#tabla td").parent().remove(); 
            
            $.ajax({
                url: '{{ url("administracion/saber_niveles/")}}/' + e.target.value,
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(response) {
                  console.log(response.length);
                  $(".loader").hide();
                  if ( response.length == 0){
                    $("#falta_datos").show();
                    $("#tabla").hide();
                  }else{
                    $("#falta_datos").hide();
                    $("#tabla").show();

                    for (var i = 0; i < response.length; i++) {
                        var no_verificado_label = '<span class="label label-danger" id="msj_verified"> No verificado</span>';
                        var verificado_label = '<span class="label label-primary" id="msj_verified">Verificado</span>'; 

                        var boton = ' <a class="label label-danger" style="background-color: #226089; color: white; font-size: 14px; border-radius: 25px; padding: 5px 20px;" href="{{ url("email/resend2/") }}/ ' + response[i].email+ ' " > Recordar </a>';

                        if ( response[i].email_verified_at == null ){
                            $('#tabla').append('<tr><td>' + response[i].id  +'</td><td>' + response[i].cedula + '</td><td>' + response[i].nombres + ' ' + response[i].apellidos + '</td><td>' + response[i].created_at + '</td><td>' + no_verificado_label + '</td><td>' + boton + '</td></tr>');   
                        }else{
                            $('#tabla').append('<tr><td>' + response[i].id  +'</td><td>' + response[i].cedula + '</td><td>' + response[i].nombres + ' ' + response[i].apellidos + '</td><td>' + response[i].created_at + '</td><td>' + verificado_label + '</td><td> Ninguno </td></tr>'); 
                        }

                        
                    }  
                  }
                      
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });

        });
    });
</script>

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
        <h4 style="color: black; text-align:center; font-size:25px;">Mi red de afiliados </h4>
    </div>
  <div class="container-fluid">
    @if (Session::has('message'))
      <div class="alert alert-success" id="msj_sesion">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        <div class="col-12  col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if($nivel->count() > 0) 
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4 col-4">
                            <p style="color:black; font-weight:bold; text-align:center"> Seleccione un nivel: </p>
                        </div>
                        <div class="col-md-8 col-8">
                            <div id="niveles">
                                <select class="form-control" id="niveles_afiliado" name="niveles_afiliado" style="width:100%;">
                                    <option value="1">Nivel 1</option>
                                    <option value="2">Nivel 2</option>
                                    <option value="3">Nivel 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="col-md-3">
                
                </div>
            </div>
           
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning" id="tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cédula</th>
                            <th>Nombres</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nivel as $nivel1)
                            <tr>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$nivel1->id}} </td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$nivel1->cedula}}</td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$nivel1->nombres}} {{$nivel1->apellidos}}</td>
                                <td style="vertical-align:middle; font-size: 16px;"> {{$nivel1->created_at}}</td>
                                @if($nivel1->email_verified_at == null or $nivel1->email_verified_at == NULL ) 
                                    <td style="vertical-align:middle; font-size: 16px;"> <span class="label label-danger" id="msj_verified"> No verificado</span></td>
                                    <td style="vertical-align:middle; font-size: 16px;">  <a class="label label-danger"  style="background-color: #226089; color: white; font-size: 14px; border-radius: 25px; padding: 5px 20px;"  href="{{ url('email/resend2/') }}/{{ $nivel1->email }}" > Recordar </a></td>  
                                @else
                                    <td style="vertical-align:middle; font-size: 16px;"> <span class="label label-primary" id="msj_verified">Verificado</span> </td>
                                    <td style="vertical-align:middle; font-size: 16px;"> Ninguno </td>
                                @endif                               
                           </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="statistic__item" style="display: none;" id="falta_datos">
                    <h2 class="number">Oh no!</h2>
                    <label style='color:#FA206A'>...No se ha encontrado ningún registro...</label>  
                    <div class="icon">
                        <i class="zmdi zmdi-mood-bad"></i>
                    </div>
                </div>

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