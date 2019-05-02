@extends('layouts.administracion')

@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px;">
        <h4 style="color: black; text-align:center; font-size:25px;">Nuevo Usuario </h4>

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

                {!! Form::label('Los campos con (*) son obligatorios', '', ['class' => 'negrita']) !!}

            {!! Form::open(['route' => 'usuarios.store','method'=>'POST','files' => true]) !!}
                <input type="hidden" name="ruta" id ="ruta" value="{{url('')}}">
                <input type="hidden" name="ip_valor" value="" id="ip_valor">
                <input type="hidden" name="navegador" value="" id="navegador">

                      <div class="row" >

                            <div class="col-md-4 col-xs-4 col-12">
                                    {!! Form::label('*Nombres:', '', ['class' => 'negrita']) !!}
                                     <div class="form-group">
                                      
                                            {!! Form::text('nombres',null,['placeholder'=>'Ingrese los nombres','class'=>'form-control', 'required']) !!}
                                    
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-4 col-12">
                                        {!! Form::label('*Apellidos:', '', ['class' => 'negrita']) !!}
                                         <div class="form-group">
                                          
                                                {!! Form::text('apellidos',null,['placeholder'=>'Ingrese los apellidos','class'=>'form-control', 'required']) !!}
                                        
                                        </div>
                                    </div>


                        <div class="col-md-4 col-xs-4 col-12">
                                <div class="form-group">
                                    {!!Form::label('Foto','Foto:')!!}
                                    {!!Form::file('path',['class'=>'form-control'])!!}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                                <div class="col-md-4 col-lg-4 col-12" >
                                        {!! Form::label('*DNI:', '', ['class' => 'negrita']) !!}
                                    {!! Form::text('cedula',null,['placeholder'=>'Ingrese su DNI','class'=>'form-control', 'required']) !!}
                                </div>

                                <div class="col-md-4 col-lg-4 col-12" >
                                        {!! Form::label('*Email:', '', ['class' => 'negrita']) !!}
                                        {!! Form::email('email',old('email'),['placeholder'=>'Ingrese el correo','class'=>'form-control', 'required']) !!}
                                        
                                    </div>

                                <div class="col-md-4 col-lg-4 col-12" >

                                        {!! Form::label('Dirección:', '', ['class' => 'negrita']) !!}
                                    {!! Form::text('direccion',null,['placeholder'=>'Ingrese su dirección','class'=>'form-control']) !!}
                               
                                       
                                </div>
                         </div>


                         <div class="row">
                                <div class="col-md-4 col-lg-4 col-12" >
                                        {!! Form::label('Teléfono:', '', ['class' => 'negrita']) !!}
                                    {!! Form::text('telefono',null,['placeholder'=>'Ingrese su teléfono','class'=>'form-control', 'onkeypress'=>'return soloNumeros(event)']) !!}
                                </div>

                                <div class="col-md-4 col-lg-4 col-12" >
                                        {!! Form::label('*Celular:', '', ['class' => 'negrita']) !!}
                                        {!! Form::text('celular',null,['placeholder'=>'Ingrese su celular','class'=>'form-control', 'onkeypress'=>'return soloNumeros(event)', 'required']) !!}
                                        
                                    </div>

                                <div class="col-md-4 col-lg-4 col-12" >

                                    {!! Form::label('*Rol', '', ['class' => 'negrita']) !!}
                                   
            
                                            <select class="form-control" name="id_roles" id="id_roles" style="width: 100%;" >
                                                

                                                  <option disabled value="" selected>Seleccione el rol</option>
                                                  <option value="Administrador">  Administrador </option>
                                                  <option value="Abogado">  Abogado </option>
                                                  <option value="Registrado">  Registrado </option>

                                                
                                                            
                                                </select>
                                               
                                       
                               
                                       
                                </div>
                         </div>

                         <div class="row">

                                <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            {!! Form::label('*Contraseña:', '', ['class' => 'negrita']) !!}
                                            <input id="password" type="password" class="form-control" placeholder="Ingrese su contraseña" name="password" required>
                              
                                            </div>
                                    </div>
            
            
                                    <div class="col-xs-12 col-md-4">
            
                                        <div class="md-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                {!! Form::label('*Confirmar contraseña:', '', ['class' => 'negrita']) !!}
                                                <input id="password_confirmation" type="password" placeholder="Repita su contraseña" class="form-control" name="password_confirmation" required>
                                               
                                                    @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            
                            
                                        </div>
            
                                   </div>

                                   <div class="col-xs-12 col-md-4" >
                                        {!! Form::label('*Ciudad:', '', ['class' => 'negrita']) !!}
                                        {!! Form::text('ciudad',null,['placeholder'=>'Ingrese su ciudad','class'=>'form-control',  'required']) !!}
                                        
                                    </div>

                         </div>

                         <div class="row">

                                <div class="col-xs-12 col-md-12">

                                        <div class="form-group">
                                            {!! Form::label('Departamentos:', '', ['class' => 'negrita']) !!}
                                                <select class="form-control select2" multiple="multiple" data-placeholder="Selecione los departamentos" name ="departamentos[]" style="width: 100%;">
                                                    @foreach($departamentos as $departamento)
                                                        <option value="{{$departamento->id}}" >  {{ $departamento->nombre_departamento }} </option>
                                                    @endforeach
                                                </select>
                                        </div>
                                         </div>


                         </div>


                        <div class="row">
                           
                            

                            <div class="col-md-12 col-xs-12" align="center" style="padding-top:20px;">
                                    {!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    
            {!! Form::close() !!}
        

    


</div>

</div>
@endsection

@section('script')

         <script src="{{url('registrados/js/validaNumerosLetras.js')}}"></script>

      

@endsection