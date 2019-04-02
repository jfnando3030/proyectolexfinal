@extends('layouts.administracion')

@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 10px">
        <h4 style="color: black; text-align:center; font-size:25px;">Usuarios Registrados </h4>

    </div>

  
  <div class="container-fluid">

    
                           
        @if (session('mensaje-registro'))
            @include('mensajes.msj_correcto')
        @endif
    <div class="row">
           <div class="col-12	col-sm-12	col-md-12	col-lg-12	col-xl-12" id="tag_container"> 

         @if(count($usuarios) >0)
               @include('usuarios-ajax')
            
               

            
            </div>

     
            @else
                <div class="col-md-12 col-lg-12">
                    <div class="statistic__item">
                        <h2 class="number">Oh no!</h2>
                        <label style='color:#FA206A'>...No se ha encontrado ningún registro...</label>  
                        <div class="icon">
                            <i class="zmdi zmdi-mood-bad"></i>
                        </div>


                        @if(Auth::user()->rol == "Administrador")


                            <div class="col-md-12 col-lg-12" align="center">
                                <a href="{{route('usuarios.create')}}"><button title="Añadir nuevo registro" id="payment-button" type="submit" class="btn btn-lg btn-info">
                                        <i class="fas fa-plus-circle"></i>
                                   
                                    
                                </button>
                                </a>
                            </div>
                        @endif
                    </div>
                   
                </div>
            
            @endif
        </div>

      

       </div>

      {!! Form::open(['route' => ['usuarios.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
        {!! Form::close() !!}
        
       


  

</div>

@endsection

@section('script')
    <script src="{{url('js/delete.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".aprobado").fadeOut(300);
            },3000);
        });
    </script>

<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html",
            beforeSend: function() {
                    $(".loader").show();
                }
        }).done(function(data){
            $("#tag_container").empty().html(data);
            $(".loader").hide();
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
</script>
      
@endsection