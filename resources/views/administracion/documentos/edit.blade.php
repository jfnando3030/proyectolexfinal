@extends('layouts.administracion')

@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px;">
        <h4 style="color: black; text-align:center; font-size:25px;">Edición de documentos </h4>

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

                {{Form::model($documento, ['route' => ['documentos.update',$documento->id],'method'=>'PUT','files' => true ])}}
                <input type="hidden" name="ruta" id ="ruta" value="{{url('')}}">

                <div class="row" >

                    <div class="col-md-4 col-xs-6">
                            {!! Form::label('Titulo del documento', '', ['class' => 'negrita']) !!}
                             <div class="form-group">
                              
                                    {!! Form::text('titulo',null,['placeholder'=>'Ingrese el titulo para el documento','class'=>'form-control']) !!}
                            
                            </div>
                        </div>


                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            {!!Form::label('Fecha Subida',' Fecha Subida:')!!}
                            {!! Form::date('fecha_post',null,['placeholder'=>'Ingrese la fecha de subida del documento','class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            {!!Form::label('PDF','PDF:')!!}
                            <input type="file" name="pdf" id="pdf" accept="application/pdf" />
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
                                    {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    
            {!! Form::close() !!}
        

    


</div>

</div>
@endsection