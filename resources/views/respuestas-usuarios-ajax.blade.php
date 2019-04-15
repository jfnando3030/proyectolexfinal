
          
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
       <!-- /.table -->
     </div>



       {{ $respuestas->links('pagination') }}