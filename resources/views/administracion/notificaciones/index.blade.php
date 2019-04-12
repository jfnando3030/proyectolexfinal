@extends('layouts.administracion')

@section('contenido')


<div class="container-fluid">

    @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif


      <div class="row" style="padding-top:15px">


        

            <div  class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Notificaciones</h3>
                </div>
                    
        
                <div class="box-body no-padding">
    
                    @if($respuestas->count()) 
        
                
    
                          @foreach($respuestas as $response)
    
                           
      
    
                                @if($response->estado !=0)
                                  @if($response->leido==0)
                                  <a style="border-bottom: 1px solid #b1b1b1; width: 100%;padding: 15px;background-color: #e4e4e4; margin-bottom: 5px; color: black;" href="{{ route('ver_respuesta',['id' => Crypt::encrypt($response->id) ])}}" >
                                    
                                    <div style="background-color: #e4e4e4;     padding-left: 25px;" class="row">

                                   

                                      <div class="row" style="width:100%">

                                          <div class="col-md-1 col-2 col-lg-1">

                                              @if($response->solicitud->abogado->path!=null)

                                              <div class="image img-cir img-40" style="margin-right: 15px;">
                                
                                               <img src="{{url('images/'.$response->solicitud->abogado->path)}}" class="user-image" alt="{{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}"  />
                                              </div> 
                                   
                                           @else
                                                <div class="image img-cir img-40" style="margin-right: 15px;">
                                                   <img src="{{url('images/no-avatar.png')}}" class="user-image" alt="{{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}"  />
     
                                                 </div>
                                               
                                               
                                           @endif


                                          </div>
                                          <div class="col-md-8 col-5 col-lg-8">
                                              <p><b> {{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}} </b></p>
    
                                          </div>
    
                                          <div class="col-md-3 col-5 col-lg-3">
    
                                              {{$response->fecha}} - {{$response->hora}}
    
                                            </div>

                                          </div>

                                          <div class="row" style="width:100%;  padding-top: 8px;">
                                            <div class="col-md-12">

                                                <p> <b>{{$response->titulo}}</b> </p>


                                            </div>

                                    

                                          </div>

                                          <div class="row" style="width:100%">
                                              <div class="col-md-12">
  
                                                  {{substr($response->respuesta, 0, 30)}}...
  
  
                                              </div>
  
                                      
  
                                            </div>
                                  
                                
                                            
                                          
                                           
                                           
                                           
                                  </div> </a>
                            
    
                                    @else 
                                    <a style="border-bottom: 1px solid #b1b1b1; width: 100%;padding: 15px;background-color: white; margin-bottom: 5px; color: black;" href="{{ route('ver_respuesta',['id' => Crypt::encrypt($response->id) ])}}" >
                                    
                                            <div style="background-color: white;     padding-left: 25px;" class="row"> 

                                              
                                              

                                                  <div class="row" style="width:100%">

                                                      <div class="col-md-1 col-2 col-lg-1">

                                                          @if($response->solicitud->abogado->path!=null)

                                                          <div class="image img-cir img-40" style="margin-right: 15px;">
                                            
                                                          <img src="{{url('images/'.$response->solicitud->abogado->path)}}" class="user-image" alt="{{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}"  />
                                                          </div> 
                                              
                                                      @else
                                                            <div class="image img-cir img-40" style="margin-right: 15px;">
                                                              <img src="{{url('images/no-avatar.png')}}" class="user-image" alt="{{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}}"  />
    
                                                            </div>
                                                          
                                                          
                                                      @endif


                                                      </div>
                                                  <div class="col-md-8 col-5 col-lg-8">
                                                      <p><b> {{$response->solicitud->abogado->nombres}} {{$response->solicitud->abogado->apellidos}} </b></p>
            
                                                  </div>
            
                                                  <div class="col-md-3 col-5 col-lg-3">
            
                                                      {{$response->fecha}} - {{$response->hora}}
            
                                                    </div>

                                                  </div>

                                                  <div class="row" style="width:100%;     padding-top: 8px;">
                                                      <div class="col-md-12">
          
                                                          <p> <b>{{$response->titulo}}</b> </p>
          
          
                                                      </div>
          
                                              
          
                                                    </div>
          
                                                    <div class="row" style="width:100%">
                                                        <div class="col-md-12">
            
                                                            {{substr($response->respuesta, 0, 30)}}...
            
            
                                                        </div>
            
                                                
            
                                                      </div>
                                                   
                                                     
                                                    
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



  
 

    
@endsection

@section('script')



@endsection








