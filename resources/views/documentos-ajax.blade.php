
<div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>


                            
                            
                          
                            <th>Titulo</th>

                            <th>Descripción</th>
                            <th>Fecha de Subida</th>
                          
                           
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($documentos as $doc)
                            @if($doc->estado !=0)
                            <tr data-id="{{$doc->id}}" onclick="window.open('{{url('public/pdf/'.$doc->pdf)}}')">
                            
                               
                                <td style="vertical-align:middle; font-size: 16px;">{{$doc->titulo}}</td>
                                <td style="vertical-align:middle; font-size: 16px;">{{$doc->descripcion}}</td>
                                <td style="vertical-align:middle; font-size: 16px;">{{$doc->fecha_post}}</td>
                
                                
                                <td>

                                 @if(Auth::user()->rol == "Administrador")
                                 <a title="Editar" class="btn btn-primary btn-circle btn-lg" href="{{ route('documentos.edit',['parameters' => Crypt::encrypt($doc->id)])}}" role="button"><i class="fa fa-edit"></i></a>
                                 <button title="Eliminar" type="button" class="btn btn-danger btn-circle btn-lg btn-delete"  ><i class="fa fa-trash"></i></button>

                                 @endif

                                    

                                   
                                     <a title="Descargar Recurso" class="btn btn-download btn-circle btn-lg" href="{{url('public/pdf/'.$doc->pdf)}}" download="{{$doc->pdf}}" role="button"><i class="fa fa-download"></i></a>


                                     <a title="Ver documento" onclick="window.open('{{url('public/pdf/'.$doc->pdf)}}')"  class="btn btn-shared btn-circle btn-lg"  role="button"><i class="fa fa-eye"></i></a>
                                    
                                   

                                </td>

                            </tr>              

                                           

                               @endif
                           @endforeach

                        
                    </tbody>
                </table>
            </div>

               

                {{ $documentos->links('pagination') }}




            

