@extends('layouts.administracion')

@section('contenido')


<div class="container-fluid">

    @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif


        <div class="row" style="padding-top:15px">
          
          <!-- /.col -->
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">{{$respuesta->titulo}}</h3>
  
         
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-read-info">
              
                  <h5 style="color:black"> <b>De: </b> {{$respuesta->solicitud->usuario->nombres}} {{$respuesta->solicitud->usuario->apellidos}}
                    <br> <b> Para: </b> Mi
                    <span class="mailbox-read-time pull-right">{{$respuesta->fecha}} - {{$respuesta->hora}}</span></h5>
                </div>
               

             

                
              
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">
                  <p>{{$respuesta->respuesta}}</p>
  
                 
                </div>
                <!-- /.mailbox-read-message -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <ul class="mailbox-attachments clearfix">

                    @if($archivos->count())
                        @foreach($archivos as $archivo)
                        

                        <?php

                    

                        

                        $extension=explode(".",$archivo->path);
                        

                        
                        ?>
                        @if($extension[1] == "pdf")
                        <?php

                            $nombre=explode("/",$archivo->path);

                            


                        ?>

                            

                            <li>
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
            
                                <div class="mailbox-attachment-info">
                                <a href="{{url('public/'.$archivo->path)}}" download="{{$nombre[1]}}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$nombre[1]}}</a>
                                    <span class="mailbox-attachment-size">
                                        
                                        <a href="{{url('public/'.$archivo->path)}}" download="{{$nombre[1]}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-download"></i></a>
                                    </span>
                                </div>
                            </li>

                        

                        @else

                           @if($extension[1] == "doc" || $extension[1] == "docx")
                        <?php

                            $nombre=explode("/",$archivo->path);

                            


                        ?>

                            

                            <li>
                                <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
            
                                <div class="mailbox-attachment-info">
                                <a href="{{url('public/'.$archivo->path)}}" download="{{$nombre[1]}}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$nombre[1]}}</a>
                                    <span class="mailbox-attachment-size">
                                      
                                        <a href="{{url('public/'.$archivo->path)}}" download="{{$nombre[1]}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-download"></i></a>
                                    </span>
                                </div>
                            </li>

                        @else 

                        @if($extension[1] == "jpg" || $extension[1] == "png" || $extension[1] == "jpeg")
                        <?php

                            $nombre=explode("/",$archivo->path);

                            


                        ?>

                            <li>
                                <span class="mailbox-attachment-icon has-img"><img src="{{url('public/'.$archivo->path)}}" alt="Attachment"></span>

                                <div class="mailbox-attachment-info">
                                <a href="{{url('public/'.$archivo->path)}}" download="{{$nombre[1]}}" class="mailbox-attachment-name"><i class="fa fa-camera"></i> {{$nombre[1]}}</a>
                                    <span class="mailbox-attachment-size">
                                        
                                        <a href="{{url('public/'.$archivo->path)}}" download="{{$nombre[1]}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-download"></i></a>
                                    </span>
                                </div>
                            </li>

                            



                        @endif

                        @endif

                        @endif


                        @endforeach

                    @endif
            
         
                  
       
                </ul>

                <div  align="center">

                <button type="button" onclick="ver()" class="btn btn-default"><i class="fa fa-reply" style="margin-right: 10px"></i> Responder</button>

                </div>
              </div>

              <div id="mostrar" style="display:none">

              <form action="{{ route('store_respuesta2') }}" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="id_user_receptor" id="id_user_receptor" value="{{ $respuesta->solicitud->id_user_solicitud }}">
                <input type="hidden" name="ip_valor1" value="" id="ip_valor1">
                <input type="hidden" name="navegador1" value="" id="navegador1">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent" style="padding: 10px;">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                    
                                             <div class="col-md-12" style="padding-bottom: 15px;">
                                                <hr>
                                                <center><h4 style="color: black; "> <strong>Formulario de respuesta </strong> </h4></center>
                                                <hr>
                                            </div>
                                            <input type="hidden" name="id_solicitud" id="id_solicitud" value="{{ $respuesta->solicitud->id }}">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Titulo de respuesta:</label>
                                                {!! Form::text('nombre',null,['placeholder'=>'Ingrese el título de su respuesta','class'=>'form-control', 'required']) !!}

                                                <label>Detalle su respuesta:</label>
                                                <textarea name="respuesta" id="respuesta" rows="9" placeholder="Escriba más información de su respuesta...    " class="form-control" required="" style="background-color: #f2f2f2;"></textarea> 
                                            </div>

                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                               
                                                <label>Cargar archivos:</label><br>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo1" id="archivo1" class="form-control" accept="image/*, doc,.docx, .pdf" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: #06379d; font-size: 11px;" id="x1"><i class="fas fa-times"></i></button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo2" id="archivo2" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: #06379d; font-size: 11px;" id="x2" ><i class="fas fa-times"></i></button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo3" id="archivo3" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: #06379d; font-size: 11px;" id="x3"><i class="fas fa-times"></i></button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo4" id="archivo4" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: #06379d; font-size: 11px;" id="x4"><i class="fas fa-times"></i></button>
                                                  </div>
                                                </div>
                                                <div class="input-group control-group increment" >
                                                  <input  type="file" name="archivo5" id="archivo5" accept="image/*, doc,.docx, .pdf" class="form-control" style="font-size: 13px;">
                                                  <div class="input-group-btn"> 
                                                    <button class="btn btn-danger" type="button" style="color: white; background-color: #06379d; font-size: 11px;" id="x5"><i class="fas fa-times"></i></button>
                                                  </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                            <div class="row">
                                <div class="col-md-4">
                            </div>

                            <div class="col-md-4" style="padding-bottom: 15px;">
                                {!! Form::submit('Enviar respuesta',['class'=>'btn btn-primary btn-block']) !!}
                            </div>

                            <div class="col-md-4">
                            
                            </div>
                        </div>
                    </div>              
                </div>
                 {!! Form::close() !!}
              </div>

            </div>



         

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

   
   

</div>



  
 

    
@endsection

@section('script')

    <script>
        $("#x1").on( "click", function() {
            $("#archivo1").val("");
        });
        $("#x2").on( "click", function() {
            $("#archivo2").val("");
        });
        $("#x3").on( "click", function() {
            $("#archivo3").val("");
        });
        $("#x4").on( "click", function() {
            $("#archivo4").val("");
        });
        $("#x5").on( "click", function() {
            $("#archivo5").val("");
        });
    </script>

<script>
    function ver() {
      document.getElementById("mostrar").style.display = "block";
    }
    </script>

@endsection