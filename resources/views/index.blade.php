@extends('layouts.registrados')

@section('contenido')

<article class="bg-secondary mb-3">  

            <div class="card-body text-center" style="padding-top:15px;">
                <h4 class="text-white">Comentarios Registrados </h4>

            </div>

  </article>

  
  <div class="container-fluid">

    @if($tarifa_activa->count())
                           
        @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif
    <div class="row">
        <div class="col-12	col-sm-12	col-md-12	col-lg-12	col-xl-12">
            @if(count($comentarios) >0) 
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            
                            
                            <th>Comentario</th>
                           
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($comentarios as $comment)
                            @if($comment->estado !=0)
                               <tr data-id="{{$comment->id}}">
                                   
                                   <td style="vertical-align:middle; font-size: 16px;">{{$comment->comentario}}</td>
                                   
                                   <td>

                                        <a title="Editar" class="btn btn-primary btn-circle btn-lg" href="{{ route('comentarios_usuarios.edit',['parameters' => Crypt::encrypt($comment->id)])}}" role="button"><i class="fa fa-edit"></i></a>
                                       <button title="Eliminar" type="button" class="btn btn-danger btn-circle btn-lg btn-delete"  ><i class="fa fa-trash"></i></button>
                                      

                                   </td>

                               </tr>
                               @endif
                           @endforeach

                        
                    </tbody>
                </table>

                {{ $comentarios->links('pagination') }}

               

            
            </div>
            <div class="text-center col-12	col-sm-12	col-md-12	col-lg-12	col-xl-12">
                <a href="{{route('comentarios_usuarios.create')}}"><button title="Añadir nuevo comentario" id="payment-button" type="submit" class="btn btn-lg btn-info">
                    <i class="fas fa-plus-circle"></i>
            
                
                    </button>
                    </a>
    
            </div>
            @else
                <div class="col-md-12 col-lg-12">
                    <div class="statistic__item">
                        <h2 class="number">Oh no!</h2>
                        <label style='color:#FA206A'>...No se ha encontrado ningún comentario...</label>  
                        <div class="icon">
                            <i class="zmdi zmdi-mood-bad"></i>
                        </div>

                            <div class="col-md-12 col-lg-12" align="center">
                                <a href="{{route('comentarios_usuarios.create')}}"><button title="Añadir nuevo comentario" id="payment-button" type="submit" class="btn btn-lg btn-info">
                                        <i class="fas fa-plus-circle"></i>
                                   
                                    
                                </button>
                            </a>
                            </div>
                    </div>
                   
                </div>
            
            @endif
        </div>

      

       </div>

      {!! Form::open(['route' => ['comentarios_usuarios.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
        {!! Form::close() !!}
        
        @else
        
        <article class="bg-secondary mb-3">  
          <div class="card-body text-center" style="padding-top: 15px;">
              <h4 class="text-white">No tiene un plan de pago activo seleccionado </h4>
          <p class="h5 text-white"> Por favor seleccione un plan</p>  
          <p><a class="btn btn-warning" target="_self" href="{{route('tarifas')}}"> Seleccionar un Plan  
          <i class="far fa-money-bill-alt"></i></a></p>
          </div>
        
        </article>
        
        @endif


   


  

</div>




 

    
@endsection

@section('script')
    <script src="{{url('administration/dist/js/roles/delete.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".aprobado").fadeOut(300);
            },3000);
        });
    </script>

      
@endsection