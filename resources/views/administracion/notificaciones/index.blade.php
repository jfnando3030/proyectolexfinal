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
                                    <tr style="background-color: #e4e4e4" onclick="window.location='{{ route('ver_respuesta',['id' => Crypt::encrypt($response->id) ])}}'" data-id="{{$response->id}}">
                  
                                       
    
                                       <td class="mailbox-star"><i class="fa fa-star text-yellow"></i></td>
    
                                       
                                      
                                    
                                      <td class="mailbox-name"><b>De: </b> {{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}</td>
                                      <td class="mailbox-subject"><b>{{$response->titulo}}</b> - {{substr($response->respuesta, 0, 30)}}...
                                      </td>
                                      <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
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








