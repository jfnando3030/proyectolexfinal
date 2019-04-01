@extends('layouts.administracion')

@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Invita gente a BanGo </h4>

    </div>

  
  <div class="container-fluid">

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
   
    <div class="emp-profile" style="padding: 3%;">
            {!! Form::open(['route' => ['enviar_mail_invitacion'],'method'=>'POST']) !!}
            <div id="msj-success" class="alert alert-success alert-dismissible aprobado" role="alert" style="display:none">
                    <strong> Credenciales Modificados Correctamente.</strong>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="ruta" id ="ruta" value="{{url('')}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6" style="padding-bottom: 15px;">
                                                <label>Nombres de tu invitado:</label>
                                                {!! Form::text('nombres',null,['placeholder'=>'Ingrese nombres de su invitado','class'=>'form-control', 'required' => 'required', 'onkeypress'=>'return soloLetras(event)']) !!}
                                            </div>
                                            <div class="col-md-6" style="padding-bottom: 15px;">
    
                                                <label>Correo electrónico:</label>
                                                {!! Form::email('email',null,['placeholder'=>'Ingrese el correo eléctronico del invitado','class'=>'form-control','required' => 'required', 'onkeypress'=>'return soloLetras(event)']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                                <div class="col-md-4">


                        </div>

                        <div class="col-md-4" style="padding-bottom: 15px;">
                                {!! Form::submit('Enviar Invitación',['class'=>'btn btn-primary btn-block']) !!}
                        </div>

                        <div class="col-md-4">
                        </div>

                    </div>
                </div>
               
              
            </div>
       

         
            {!! Form::close() !!}
              
    </div>

</div>



  
 

    
@endsection

@section('script')

    <script src="{{url('administration/dist/js/validaNumerosLetras.js')}}"></script>

@endsection