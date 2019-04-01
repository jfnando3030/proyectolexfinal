
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>


                            
                            
                            <th>Imagen</th>

                            <th>Titulo</th>

                            <th>Descripción</th>
                            <th>Dimensiones</th>
                          
                           
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($herramientas as $herramienta)
                            @if($herramienta->estado !=0)
                               <tr data-id="{{$herramienta->id}}">
                            
                                   
                                   <td> <a data-fancybox="id{{$herramienta->id}}" href="{{url('images/'.$herramienta->path)}}"><img  src="{{url('images/'.$herramienta->path)}}" alt="{{$herramienta->titulo}}" style="max-width: 100%;height: auto;"/>  </a></td>
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

                              


                                 <!-- The Modal -->
                                <div class="modal" id="{{$herramienta->id}}">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                        
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <div  class="modal-body">
                                                
                                                <p style="color:black;font-weight: bold;"> Código embed: </p>
                                                    <input readonly="" style="width:100%;     background: #d6d6d6;" type="text" value='<div align="center"><a href="{{ url("administracion/invita/bango/".Auth::user()->nombres."/".Auth::user()->cedula)}}" target="_blank" > <img src="{{url('images/'.$herramienta->path)}}" alt="Hola"  style="max-width: 100%;height: auto;"> </a></div>' id="texto{{$herramienta->id}}">
                                                   
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div align="center" class="modal-footer">
                                                    <div class="tooltip">
                                                          
                                                        <button type="button" class="btn btn-danger" onclick="myFunction{{$herramienta->id}}()" onmouseout="outFunc()">
                                                              <span class="tooltiptext" id="myTooltip{{$herramienta->id}}">Copiar código embed</span>
                                                                Copiar
                                                        </button>
                                                    </div>

                                              
                                              <a title="Descargar Recurso" class="btn btn-download btn-circle btn-lg" href="{{url('images/'.$herramienta->path)}}" download="{{$herramienta->path}}" role="button"><i class="fa fa-download"></i></a>
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </div>

                                    <script>
                                            function myFunction{{$herramienta->id}}() {


                                                var myCode = document.getElementById("texto{{$herramienta->id}}").value;
                                                var fullLink = document.createElement('input');
                                                document.body.appendChild(fullLink);
                                                fullLink.value =  myCode;
                                                fullLink.select();
                                                document.execCommand("copy", false);
                                                fullLink.remove();
                                                var tooltip = document.getElementById("myTooltip{{$herramienta->id}}");
                                                tooltip.innerHTML = "Texto Copiado"


                                            }

                                            function outFunc() {
                                            var tooltip = document.getElementById("myTooltip{{$herramienta->id}}");
                                            tooltip.innerHTML = "Copiar código embed";
                                            }
                                    
                                    
                                    
                                            </script>

                                           

                               @endif
                           @endforeach

                        
                    </tbody>
                </table>

               

                {{ $herramientas->links('pagination') }}

  
