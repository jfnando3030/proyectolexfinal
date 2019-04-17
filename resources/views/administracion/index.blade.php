@extends('layouts.administracion')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style type="text/css">
  #letras_spam{
    font-size: 13px;
    text-align: center;
    color: white;
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

  @if (session('mensaje-registro'))
    @include('mensajes.msj_correcto')
  @endif

  @if (session('mensaje-error'))
    @include('mensajes.msj_rechazado')
  @endif

  @if(Auth::user()->rol == "Administrador")
    <p style="color:black; text-align:center"> Bienvenido Súper Administrador </p>
  @else 
    @if(Auth::user()->rol == "Abogado")
    <!-- Main content -->
    <section class="content2">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Menú de opciones</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul id="hola" class="nav nav-pills nav-stacked">
                <?php
                  $contador=0;
                ?>
                @foreach($solicitudes_nuevos as $nuevo)
                  @if($nuevo->estado_solicitud !=0)
                    @foreach($user_departamentos as $user)
                      @if($user->departamento_id==$nuevo->id_departamento )
                        <?php
                          $contador+=1;
                        ?>
                      @endif
                    @endforeach
                  @endif
                @endforeach
                <li  class="active"><a onclick="ocultar_div()" data-toggle="pill" href="#menu1"><i class="fa fa-inbox"></i> Respuestas
                <span class="label label-primary pull-right">{{$total_respuestas}}</span></a></li>
                <li  ><a onclick="ocultar_div()" data-toggle="pill" href="#menu2"><i class="fa fa-file-text"></i> Nuevos<span class="label label-primary pull-right">{{$contador}}</span></a>
                <li  ><a onclick="ocultar_div()" data-toggle="pill" href="#menu3"><i class="fa fa-clock-o"></i> En curso
                  <span class="label label-primary pull-right">{{$total_solicitudes_usuario}}</span></a></li>
                <li  ><a onclick="ocultar_div()" data-toggle="pill" href="#menu4"><i class="fa fa-ban"></i> Finalizados <span class="label label-primary pull-right">{{$total_finalizados_usuario}}</span></a></li>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-12 col-lg-12 col-12" id="panelcito">
          <div  class="box box-primary tab-pane fade in active">
            <div class="box-header with-border">
              <h3 class="box-title">Bandeja de entrada</h3>
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- /.box-header -->
                <div class="box-body no-padding">        
                  @if($respuestas->count()) 
                    <div class="table-responsive mailbox-messages">
                      <table id="example4" class="table table-hover table-striped">
                        <thead>
                          <tr class="fila">                                                  
                            <th>Emisor</th>
                            <th>Mensaje</th>
                            <th>Adjuntos</th>
                            <th>Fecha</th>
                          </tr>
                        </thead>
                        
                        <tbody> 
                          @foreach($respuestas as $response)
                            @if($response->estado !=0)
                              <tr onclick="window.location='{{ route('ver_respuesta',['id' => $response->id])}}'" data-id="{{$response->id}}">   
                                <td class="mailbox-name"><b>De: </b> {{$response->solicitud->usuario->nombres}} {{$response->solicitud->usuario->apellidos}}</td>
                                <td class="mailbox-subject"><b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}}...
                                </td>
                                @if($response->tiene_archivo_adjunto ==1)
                                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                @else 
                                <td> </td>

                                @endif
                                <td class="mailbox-date">{{$response->fecha}} - {{$response->hora}}</td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  @else
                    <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No tiene respuesta en su bandeja de entrada </p>
                  @endif
                </div>
              </div>                  
            </div>
          </div>
        </div>

        <div id="contenido" class="col-md-12 col-lg-12 col-12 tab-content" style="display:none;">
          <div id="menu1" class="box box-primary tab-pane fade in active">
            <div class="box-header with-border">
              <h3 class="box-title">Bandeja de entrada</h3>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box-body no-padding">
                  @if($respuestas->count()) 
                    <div class="table-responsive mailbox-messages">
                      <table id="example5" class="table table-hover table-striped">
                        <thead>
                          <tr class="fila">
                            <th>Emisor</th>
                            <th>Mensaje</th>
                            <th>Adjuntos</th>
                            <th>Fecha</th>
                          </tr>
                        </thead>
                        <tbody> 
                          @foreach($respuestas as $response)
                            @if($response->estado !=0)
                              @if($response->leido==0) 
                                <tr style="background-color: #e4e4e4" onclick="window.location='{{ route('ver_respuesta2',['id' => Crypt::encrypt($response->id) ])}}'" data-id="{{$response->id}}">
                                  <td class="mailbox-name"><b>De: </b> {{$response->solicitud->usuario->nombres}} {{$response->solicitud->usuario->apellidos}}</td>
                                  <td class="mailbox-subject"><b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}}...
                                  </td>
                                  @if($response->tiene_archivo_adjunto ==1)
                                    <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                  @else 
                                    <td> </td>
                                  @endif
                                  <td class="mailbox-date">{{$response->fecha}} - {{$response->hora}}</td>
                                </tr>
                              @else 
                                <tr onclick="window.location='{{ route('ver_respuesta2',['id' => Crypt::encrypt($response->id) ])}}'" data-id="{{$response->id}}">
                                  <td class="mailbox-name"><b>De: </b> {{$response->solicitud->usuario->nombres}} {{$response->solicitud->usuario->apellidos}}</td>
                                  <td class="mailbox-subject"><b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}}...
                                  </td>
                                  @if($response->tiene_archivo_adjunto ==1)
                                    <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                  @else 
                                    <td> </td>
                                  @endif
                                  <td class="mailbox-date">{{$response->fecha}} - {{$response->hora}}</td>
                                </tr>
                              @endif
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  @else
                    <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No tiene respuesta en su bandeja de entrada </p>
                  @endif
                </div>
              </div>                  
            </div>
          </div>
          
          <div id="menu2" class="box box-primary tab-pane fade">   
            <div class="box-header with-border">
              <h3 class="box-title">Nuevas Solicitudes </h3>
            </div>
            
            <div class="box-body no-padding">
              @if($solicitudes_nuevos->count())        
                <div class="table-responsive mailbox-messages">
                  <table id="example6" class="table table-hover table-striped">
                    <thead>
                      <tr class="fila">
                        <th>Emisor</th>
                        <th>Mensaje</th>
                        <th>Adjuntos</th>
                        <th>Departamento</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($solicitudes_nuevos as $nuevo)
                        @if($nuevo->estado_solicitud !=0)                 
                          @foreach($user_departamentos as $user)
                            @if($user->departamento_id==$nuevo->id_departamento )
                              <tr onclick="window.location='{{ route('ver_caso',['id' => Crypt::encrypt($nuevo->id)])}}'" data-id="{{$nuevo->id}}">
                                <td class="mailbox-name"><b>{{$nuevo->usuario->nombres}} {{$nuevo->usuario->apellidos}}</b></td>
                                <td class="mailbox-subject"><b>{{$nuevo->nombre_solicitud}}</b> - {{substr($nuevo->descripcion, 0, 30)}}...
                                </td>
                                @if($nuevo->tiene_archivo_adjunto ==1)
                                  <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                @else 
                                  <td> </td>
                                @endif
                                <td class="mailbox-date">{{$nuevo->departamento->nombre_departamento}}</td>
                                <td class="mailbox-date">{{$nuevo->fecha_solicitud}} - {{$nuevo->hora_solicitud}}</td>
                              </tr>
                            @endif
                          @endforeach
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No existen solicitudes nuevas </p>
              @endif
            </div>
          </div>        
        
          <div id="menu3" class="box box-primary tab-pane fade">
            <div class="box-header with-border">
              <h3 class="box-title">Casos asignados</h3>
            </div>
            
            <div class="box-body no-padding">
              @if($solicitudes_usuario->count())
                <div class="table-responsive mailbox-messages">
                  <table  id="example7" class="table table-hover table-striped">
                    <thead>
                      <tr class="fila">
                        <th>Emisor</th>
                        <th>Mensaje</th>
                        <th>Adjuntos</th>
                        <th>Departamento</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($solicitudes_usuario as $nuevo)
                        @if($nuevo->estado_solicitud !=0)
                          <tr onclick="window.location='{{ route('respuesta',['id' => Crypt::encrypt($nuevo->id)])}}'" data-id="{{$nuevo->id}}">
                            <td class="mailbox-name"><b>{{$nuevo->usuario->nombres}} {{$nuevo->usuario->apellidos}}</b></td>
                            <td class="mailbox-subject"><b>{{$nuevo->nombre_solicitud}}</b> - {{substr($nuevo->descripcion, 0, 30)}}...
                            </td>
                            @if($nuevo->tiene_archivo_adjunto ==1)
                              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                            @else 
                              <td> </td>
                            @endif
                            <td class="mailbox-date">{{$nuevo->departamento->nombre_departamento}}</td>
                            <td class="mailbox-date">{{$nuevo->fecha_solicitud}} - {{$nuevo->hora_solicitud}}</td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No existen casos para usted </p>
              @endif
            </div>          
          </div>

          <div id="menu4" class="box box-primary tab-pane fade">
            <div class="box-header with-border">
              <h3 class="box-title">Casos finalizados</h3>
            </div>

            <div class="box-body no-padding">
              @if($finalizados_usuarios->count())
                <div class="table-responsive mailbox-messages">
                  <table id="example8" class="table table-hover table-striped">
                    <tbody>
                      <thead>
                        <tr class="fila">
                          <th>Emisor</th>
                          <th>Mensaje</th>
                          <th>Adjuntos</th>
                          <th>Departamento</th>
                          <th>Fecha</th>
                        </tr>
                      </thead>
                      @foreach($finalizados_usuarios as $nuevo)
                        @if($nuevo->estado_solicitud !=0)
                          <a href="{{ route('respuesta',['id' => $nuevo->id])}}">
                            <tr data-id="{{$nuevo->id}}">
                              <td class="mailbox-name"><b>{{$nuevo->usuario->nombres}} {{$nuevo->usuario->apellidos}}</b></td>
                              <td class="mailbox-subject"><b>{{$nuevo->nombre_solicitud}}</b> - {{substr($nuevo->descripcion, 0, 30)}}...
                              </td>
                              @if($nuevo->tiene_archivo_adjunto ==1)
                                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                              @else 
                                <td> </td>
                              @endif
                              <td class="mailbox-date">{{$nuevo->departamento->nombre_departamento}}</td>
                              <td class="mailbox-date">{{$nuevo->fecha_solicitud}} - {{$nuevo->hora_solicitud}}</td>
                            </tr>
                          </a>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No tiene casos finalizados </p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  @else 
    <section class="content2">
      <div class="row">
        <div class="col-md-3 col-lg-2 col-12">
          @if( $saber_tarifa->count() )
            <a  class="btn btn-primary btn-block margin-bottom" title="Redactar nueva solicitud" href="{{url('administracion/solicitud/registrar')}}"><i class="fa fa-plus" style="margin-right: 2px;"></i> Redactar</a>
          @else
            <a class="btn btn-default btn-block margin-bottom" title="Redactar nueva solicitud" disabled href="#"><i class="fa fa-plus" ></i> Redactar</a>
          @endif
        </div>
        <div class="col-md-9 col-lg-10 col-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Opciones</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul id="hola" class="nav nav-pills nav-stacked">   
                <li class="active" ><a onclick="ocultar_div()" data-toggle="pill" href="#menu5"><i class="fa fa-inbox"></i> Recibidos <span class="label label-primary pull-right">{{$total_respuestas}}</span></a>
                <li  ><a onclick="ocultar_div()" data-toggle="pill" href="#menu6"><i class="fa fa-envelope"></i> Enviados
                <span class="label label-primary pull-right">{{$total_solicitudes_registrados}}</span></a></li>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 col-lg-12 col-12" id="panelcito">
          <div  class="box box-primary tab-pane fade in active">
            <div class="box-header with-border">
              <h3 class="box-title">Respuestas</h3>
            </div>

            <div class="box-body no-padding">          
              @if($respuestas->count()) 
                <div class="table-responsive mailbox-messages">
                  <table id="example9" class="table table-hover table-striped">
                    <thead>
                      <tr class="fila">
                        <th>Emisor</th>
                        <th>Mensaje</th>
                        <th>Adjuntos</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>

                    <tbody>    
                      @foreach($respuestas as $response)
                        @if($response->estado !=0)
                          <tr onclick="window.location='{{ route('ver_respuesta',['id' => $response->id])}}'" data-id="{{$response->id}}">
                            <td class="mailbox-name"><b>De: </b> {{$response->solicitud->usuario->nombres}} {{$response->solicitud->usuario->apellidos}}</td>
                            <td class="mailbox-subject"><b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}} ...
                            </td>
                            @if($response->tiene_archivo_adjunto ==1)
                              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                            @else 
                              <td> </td>
                            @endif
                            <td class="mailbox-date">{{$response->fecha}} - {{$response->hora}}</td>
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No tiene respuesta en su bandeja de entrada </p>
              @endif
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div id="contenido" class="col-md-12 col-lg-12 col-12 tab-content" style="display:none;">
          <div id="menu5" class="box box-primary tab-pane fade in active">
            <div class="box-header with-border">
                <h3 class="box-title">Respuestas</h3>
            </div>

            <div class="box-body no-padding">
              @if($respuestas->count()) 
                <div class="table-responsive mailbox-messages">
                  <table id="example10" class="table table-hover table-striped">
                    <thead>
                      <tr class="fila">
                        <th></th>
                        <th>Emisor</th>
                        <th>Mensaje</th>
                        <th>Adjuntos</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    
                    <tbody> 
                      @foreach($respuestas as $response)
                        @if($response->estado !=0)
                          @if($response->leido==0)
                            <tr style="background-color: #e4e4e4" onclick="window.location='{{ route('ver_respuesta',['id' => Crypt::encrypt($response->id) ])}}'" data-id="{{$response->id}}">
                              <td class="mailbox-star"><i class="fa fa-star text-yellow"></i></td>
                              <td class="mailbox-name"><b>De: </b> {{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}</td>
                              <td class="mailbox-subject"><b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}}...
                              </td>
                              @if($response->tiene_archivo_adjunto ==1)
                                <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                              @else 
                                <td> </td>
                              @endif
                              <td class="mailbox-date">{{$response->fecha}} - {{$response->hora}}</td>
                            </tr>
                          @else 
                            <tr onclick="window.location='{{ route('ver_respuesta',['id' => Crypt::encrypt($response->id) ])}}'" data-id="{{$response->id}}">
                              <td class="mailbox-star">  <i class="far fa-star text-yellow"></i></td>
                              <td class="mailbox-name"><b>De: </b> {{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}</td>
                              <td class="mailbox-subject"><b>{{$response->titulo}}</b> - {{$response->respuesta}}...
                              </td>
                              <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                              <td class="mailbox-date">{{$response->fecha}} - {{$response->hora}}</td>
                            </tr>
                          @endif
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No tiene respuesta en su bandeja de entrada </p>
              @endif
            </div>
          </div>                        
          
          <div id="menu6" class="box box-primary tab-pane fade">
            <div class="box-header with-border">
              <h3 class="box-title">Solicitudes Enviadas</h3>
            </div>          
      
            <div class="box-body no-padding">
              @if($solicitudes_registrados->count())
                <div class="table-responsive mailbox-messages">
                  <table id="example11" class="table table-hover table-striped">
                    <thead>
                      <tr class="fila">
                        <th>Emisor</th>
                        <th>Mensaje</th>
                        <th>Adjuntos</th>
                        <th>Fecha</th>                             
                      </tr>
                    </thead>
                      
                    <tbody>
                      @foreach($solicitudes_registrados as $nuevo)
                        @if($nuevo->estado_solicitud !=0)
                         <tr onclick="window.location='{{ route('ver_caso',['id' => Crypt::encrypt($nuevo->id)])}}'" data-id="{{$nuevo->id}}">
                          <td class="mailbox-name"><b>Para: {{$nuevo->departamento->nombre_departamento}}</b></td>
                          <td class="mailbox-subject"><b>{{$nuevo->nombre_solicitud}}</b> - {{substr($nuevo->descripcion, 0, 30)}} ...
                          </td>
                          @if($nuevo->tiene_archivo_adjunto ==1)
                            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                          @else 
                            <td> </td>
                          @endif
                          <td class="mailbox-date">{{$nuevo->fecha_solicitud}} - {{$nuevo->hora_solicitud}}</td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  <!-- /.table -->
                </div>                  
              @else
                <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No existe solicitudes enviadas </p>      
              @endif
            </div> 
          </div>
        </div>
      </div>
    </section>
  @endif
@endif

@endsection

@section('script')

  <script>

    function ocultar_div(){
     
      var el = document.getElementById('panelcito');
      el.style.display = 'none'; 
      var el = document.getElementById('contenido');
      el.style.display = 'block'; 
    }

    $(function() {
      $('#hola').find('a').click(function(e) {
          e.preventDefault();
          $(this.hash).show().siblings().hide();
          $('#hola').find('a').parent().removeClass('active')
          $(this).parent().addClass('active')
      }).filter(':first').click();
    });

    function myFunction2() {
      $(".loader").show();
    }
  </script>    
@endsection
