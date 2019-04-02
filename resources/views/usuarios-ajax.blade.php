
            <div class="table-responsive table--no-card m-b-30">
                <table id="example2" class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            
                            
                            <th>Foto</th>

                            <th>Nombres</th>

                           
                            <th>Cédula</th>
                            <th>Email</th>
                            <th>Rol</th>

                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($usuarios as $user)
                            @if($user->estado !=0)
                               <tr data-id="{{$user->id}}">
                            
                                   
                              @if($user->path!=null)
                                    <td>
                                        <img src="{{url('images/'.$user->path)}}" alt="" style="width:50px; height: 50px;"/>
                                    </td>
                                @else
                                    <td>
                                        <img src="{{url('images/no-avatar.png')}}" alt="" style="width:50px; height: 50px;"/>
                                    </td>
                                @endif
                                   <td style="vertical-align:middle; font-size: 16px;">{{$user->nombres}} {{$user->apellidos}}</td>
                                  

                                   <td style="vertical-align:middle; font-size: 16px;">{{$user->cedula}} </td>
                                   <td style="vertical-align:middle; font-size: 16px;">{{$user->email}} </td>
                                   <td style="vertical-align:middle; font-size: 16px;">{{$user->rol}} </td>

                                   
                                   <td>

                                 
                                    <a title="Editar" class="btn btn-primary btn-circle btn-lg" href="{{ route('usuarios.edit',['parameters' => Crypt::encrypt($user->id)])}}" role="button"><i class="fa fa-edit"></i></a>
                                    <button title="Eliminar" type="button" class="btn btn-danger btn-circle btn-lg btn-delete"  ><i class="fa fa-trash"></i></button>


                                   </td>

                               </tr>

                              


                            

                                  

                                           

                               @endif
                           @endforeach

                        
                    </tbody>
                </table>

               

                {{ $usuarios->links('pagination') }}

  
