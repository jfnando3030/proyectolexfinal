@extends('layouts.administracion')

@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px;">
        <h4 style="color: black; text-align:center; font-size:25px;">Subir nuevo banner </h4>

    </div>

<div class="container-fluid" style="padding-top: 15px">

        <div class="emp-profile" style="padding: 3%;">
                                
                @if (session('mensaje-registro'))
                    @include('mensajes.msj_correcto')
                @endif
                @if(!$errors->isEmpty())
                    <div class="alert alert-danger">
                        <p><strong>Error!! </strong>Corrija los siguientes errores</p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            {!! Form::open(['route' => 'herramientas.store','method'=>'POST','files' => true]) !!}
                <input type="hidden" name="ruta" id ="ruta" value="{{url('')}}">

                      <div class="row" >

                            <div class="col-md-6 col-xs-6">
                                    {!! Form::label('Titulo de la imagen', '', ['class' => 'negrita']) !!}
                                     <div class="form-group">
                                      
                                            {!! Form::text('titulo',null,['placeholder'=>'Ingrese el titulo de la imagen','class'=>'form-control']) !!}
                                    
                                    </div>
                                </div>


                        <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    {!!Form::label('Foto','Foto:')!!}
                                    {!!Form::file('path',['class'=>'form-control'])!!}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                           
                            

                            <div class="col-md-12 col-xs-12">
                                    {!! Form::label('Descripcion', '', ['class' => 'negrita']) !!}
                                     <div class="form-group">
                                      
                                        {!! Form::textarea('descripcion', null, ['id' => 'descripcion', 'rows' => 6, 'style' => 'resize:none; width:100%', 'placeholder'=>'Ingrese una descripción']) !!}
                                    
                                    </div>
                                </div>

                            <div class="col-md-12 col-xs-12" align="center" style="padding-top:20px;">
                                    {!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    
            {!! Form::close() !!}
        

    


</div>

</div>
@endsection