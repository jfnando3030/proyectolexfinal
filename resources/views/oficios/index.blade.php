@extends('layouts.administracion')
@section('contenido')
<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 10px">
    <h4 style="color: black; text-align:center; font-size:25px;">
        Listado de Oficios Generados
    </h4>
</div> 
<div class="container-fluid">
    <div class="emp-profile" style="padding: 3%;">
        @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
        @endif
        @if (session('mensaje-error'))
            @include('mensajes.msj_rechazado')
        @endif
        <div class="row">
            <div class="col-12	col-sm-12	col-md-12	col-lg-12	col-xl-12" id="tag_container"> 
                @if(count($oficios) >0)

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Título</th>
      <th scope="col">Fecha</th>
      <th scope="col">Usuario</th> 
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($oficios as $ofi)
    <tr>
      <th scope="row">{{ $ofi->id }}</th>
      <td>{{ $ofi->titulo_documento }}</td>
      <td>{{ $ofi->fecha }}</td>
      <td>{{ $ofi->usuario }}</td>
      <td style="text-align: center;">
      @if(Auth::user()->rol == "Administrador")
        <a class="btn btn-primary" href="{{url('administracion/oficios/pdf', Crypt::encrypt($ofi->id) )}}">
        <i class="far fa-file-alt"></i>
        </a>
      @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $oficios->links('pagination') }}
                    
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
                        <a href="{{url('administracion/oficio')}}">
                            <button title="Añadir nuevo registro" id="payment-button" type="submit" class="btn btn-lg btn-info">
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
    
</div>
</div>   
@endsection