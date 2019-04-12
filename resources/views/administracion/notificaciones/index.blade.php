@extends('layouts.administracion')

@section('contenido')


<div class="container-fluid">

    @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif


      <div class="row" style="padding-top:15px">


        <div  class="box box-primary">

            <div  class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Notificaciones</h3>
                </div>
                    
        
                <div class="box-body no-padding">
    
                    @if($respuestas->count()) 
        
                
    
                          @foreach($respuestas as $response)
    
                           
      
    
                                @if($response->estado !=0)
                                  @if($response->leido==0)
                                  <a style="width: 100%;padding: 15px;background-color: #e4e4e4;" href="{{ route('ver_respuesta',['id' => Crypt::encrypt($response->id) ])}}" >
                                    
                                    <div style="background-color: #e4e4e4" class="row">
                                            <b>De: </b> {{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}
                                            <b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}}...
                                            <i class="fa fa-paperclip"></i>
                                            {{$response->fecha}} - {{$response->hora}}
                                  </div> </a>
                            
    
                                    @else 
                                    <a style="width: 100%;padding: 15px;background-color: white;" href="{{ route('ver_respuesta',['id' => Crypt::encrypt($response->id) ])}}" >
                                    
                                            <div style="background-color: white" class="row">
                                                    <b>De: </b> {{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}
                                                    <b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}}...
                                                    <i class="fa fa-paperclip"></i>
                                                    {{$response->fecha}} - {{$response->hora}}
                                          </div> </a>
                                       
                                     
                                       @endif
              
                          
              
                                    @endif
    
                                
                              @endforeach
                      
                  
                 
              
    
                      @else
      
                      <p style="text-align: center;color: black;padding: 30px;font-size: 20px;">No tiene respuesta en su bandeja de entrada </p>
                
                
                
                      
                        @endif
                    </div>
                  </div>
                </div>   


          
          
        </div>
       

   
   

</div>



  
 

    
@endsection

@section('script')



@endsection








