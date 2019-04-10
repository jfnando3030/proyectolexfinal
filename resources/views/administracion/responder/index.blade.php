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
              
                  <h5 style="color:black"> <b>De: </b> {{$respuesta->solicitud->abogado->nombres}} {{$respuesta->solicitud->abogado->apellidos}}
                    <br> <b> Para: </b> Mi
                    <span class="mailbox-read-time pull-right">{{$respuesta->fecha}} - {{$respuesta->hora}}</span></h5>
                </div>
               

                   <div class="mailbox-controls with-border text-center">
                        <a href="#"  class="btn btn-sm btn-primary">Responder</a>
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
              </div>

            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

   
   

</div>



  
 

    
@endsection