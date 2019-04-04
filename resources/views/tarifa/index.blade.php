@extends('layouts.administracion')
@section('contenido')
<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 10px">
    <h4 style="color: black; text-align:center; font-size:25px;">
        Listado de Tarifas
    </h4>
</div> 
<div class="container-fluid">
    <div class="emp-profile" style="padding: 3%;">
        @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
        @endif
        <div class="row">
            <div class="col-12	col-sm-12	col-md-12	col-lg-12	col-xl-12" id="tag_container"> 
                @if(count($tarifas) >0)

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Precio</th>
      <th scope="col">Descripción</th>
      <!-- <th scope="col">Estado</th> -->
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tarifas as $taf)
    <tr>
      <th scope="row">{{ $taf->id }}</th>
      <td>{{ $taf->tarifa }}</td>
      <td>{{ $taf->precio }}</td>
      <td>{{ $taf->descripcion }}</td>
      <!-- <td>
          @if($taf->estado == 1)
          <i class="fas fa-toggle-on"></i>
          @else
            <i class="fal fa-toggle-off"></i>
          @endif
      </td>  -->
      <td>
      @if(Auth::user()->rol == "Administrador")
        <form action="{{route('tarifa.destroy', Crypt::encrypt($taf->id))}}" method="POST">
        @csrf
        @method('DELETE')
        <a class="btn btn-primary" href="{{route('tarifa.edit', Crypt::encrypt($taf->id) )}}">
            <i class="far fa-edit"></i>
        </a>
        <button type="submit" class="btn btn-primary">
        <i class="far fa-trash-alt"></i>
        </button>
        </form>
      @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $tarifas->links('pagination') }}
                    
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
                        <a href="{{route('tarifa.create')}}">
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