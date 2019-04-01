@extends('layouts.administracion')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style type="text/css">
  #letras_spam{
    font-size: 13px;
    text-align: center;
    color: white;
  }
</style>

 <script type="text/javascript">
  $(document).ready(function() {
      setTimeout(function() {
          $("#msj_sesion").fadeOut(2000);
      },5000);
  });
</script>


@section('contenido')

    @if (session('mensaje-registro'))
    @include('mensajes.msj_correcto')
    @endif

    @if (session('mensaje-error'))
    @include('mensajes.msj_rechazado')
    @endif

        <div class="section__content section__content--p30">
          <br>
          <div class="container-fluid">
            @if (Session::has('message'))
              <div class="alert alert-success" id="msj_sesion">{{ Session::get('message') }}</div>
            @endif
     
        </div>
      </div>
         

@endsection


@section('script')




      
@endsection
