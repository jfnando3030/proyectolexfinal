
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            
                            
                            <th>Foto</th>

                            <th>Nombres</th>

                            <th>Apellidos</th>
                            <th>Cédula</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Celular</th> 
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($usuarios as $user)
                            @if($user->estado !=0)
                               <tr data-id="{{$user->id}}">
                            
                                   
                              @if($usuario->path!=null)
                                    <td>
                                        <img src="{{url('images/'.$user->path)}}" alt="" style="width:50px;"/>
                                    </td>
                                @else
                                    <td>
                                        <img src="{{url('images/no-avatar.png')}}" alt="" style="width:50px;"/>
                                    </td>
                                @endif
                                   <td style="vertical-align:middle; font-size: 16px;">{{$herramienta->titulo}}</td>
                                   <td style="vertical-align:middle; font-size: 16px;">{{$herramienta->descripcion}}</td>
                   
                                   <?php

                                   list($width, $height, $type, $attr) = getimagesize(url('images/'.$herramienta->path));

                                 

                                   
                                   ?>

                                   <td style="vertical-align:middle; font-size: 16px;">Ancho: {{$width}}px <br>  Alto {{$height}}px </td>
                                   
                                   <td>

                                    @if(Auth::user()->rol == "Administrador")
                                    <a title="Editar" class="btn btn-primary btn-circle btn-lg" href="{{ route('herramientas.edit',['parameters' => Crypt::encrypt($herramienta->id)])}}" role="button"><i class="fa fa-edit"></i></a>
                                    <button title="Eliminar" type="button" class="btn btn-danger btn-circle btn-lg btn-delete"  ><i class="fa fa-trash"></i></button>

                                    @endif

                                       

                                      
                                        <a title="Descargar Recurso" class="btn btn-download btn-circle btn-lg" href="{{url('images/'.$herramienta->path)}}" download="{{$herramienta->path}}" role="button"><i class="fa fa-download"></i></a>
                                        
                                        <a title="Compartir" data-toggle="modal" data-target="#{{$herramienta->id}}" class="btn btn-shared btn-circle btn-lg"  role="button"><i class="fa fa-share-alt"></i></a>
                                       
                                      

                                   </td>

                               </tr>

                              


                            

                                  

                                           

                               @endif
                           @endforeach

                        
                    </tbody>
                </table>

               

                {{ $herramientas->links('pagination') }}

  
