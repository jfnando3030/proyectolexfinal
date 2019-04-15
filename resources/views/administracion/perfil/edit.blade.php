@extends('layouts.administracion')

@section('contenido')



  
  <div class="container-fluid" style="padding-top: 15px">

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
   
    <div class="emp-profile">
            {{Form::model($usuario, ['route' => ['perfil.update',$usuario->id],'method'=>'PUT','files' => true ])}}
            <div id="msj-success" class="alert alert-success alert-dismissible aprobado" role="alert" style="display:none">
                    <strong> Credenciales Modificados Correctamente.</strong>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" name="ruta" id ="ruta" value="{{url('')}}">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        @if(Auth::user()->path!=null)
                           
                        <img src="{{url('images/'.Auth::user()->path)}}" class="user-image" alt="Mi Foto" id="preview_image" />
                        <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 10%;display: none"></i>
                        <div class="file btn btn-lg btn-primary">
                                Cambiar Foto
                                <input type="file" name="path" id="file"/>
                                <input type="hidden" id="file_name"/>
                            </div>
                    
                        @else
                            
                                <img src="{{url('images/no-avatar.png')}}" class="user-image" alt="MI Foto" id="preview_image" />
                                <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
                            
                                <div class="file btn btn-lg btn-primary">
                                        Cambiar Foto
                                        <input type="file" name="path" id="file"/>
                                        <input type="hidden" id="file_name"/>
                                    </div>
                        @endif
                    </div>

   


                </div>
                <div class="col-md-8">
                    <div class="profile-head">
                                <h5>
                                    {!! Auth::user()->nombres.' '.Auth::user()->apellidos !!}
                                </h5>
                                <h6 style="padding-bottom:15px;">
                                    Usuario Registrado
                                </h6>
                               
                    
                    </div>
                    <div class="row">
                
                            <div class="col-md-12 col-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-md-6" >
                                                        <label>Nombres:</label>
                                                        {!! Form::text('nombres',null,['placeholder'=>'Ingrese sus Nombres','class'=>'form-control', 'onkeypress'=>'return soloLetras(event)']) !!}
                                                    </div>
                                                    <div class="col-md-6" >
            
                                                        <label>Apellidos:</label>
                                                        {!! Form::text('apellidos',null,['placeholder'=>'Ingrese sus apellidos','class'=>'form-control','onkeypress'=>'return soloLetras(event)']) !!}
                                                   
                                                           
                                                    </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6" >
                                                            <label>DNI:</label>
                                                            {!! Form::text('cedula',null,['placeholder'=>'Ingrese su DNI','class'=>'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-6" >
                
                                                            <label>Dirección:</label>
                                                            {!! Form::text('direccion',null,['placeholder'=>'Ingrese su dirección','class'=>'form-control']) !!}
                                                       
                                                               
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                            <div class="col-md-6" >
                                                                <label>Teléfono:</label>
                                                                {!! Form::text('telefono',null,['placeholder'=>'Ingrese su teléfono','class'=>'form-control', 'onkeypress'=>'return soloNumeros(event)']) !!}
                                                            </div>
                                                            <div class="col-md-6" >
                    
                                                                <label>Celular:</label>
                                                                {!! Form::text('celular',null,['placeholder'=>'Ingrese su celular','class'=>'form-control']) !!}
                                                           
                                                                   
                                                            </div>
                                                        </div>

                                                 

                                                <div class="row">
                                                    <div class="col-md-6" >
                                                            <label>Email:</label>
                                                            {!! Form::email('email',old('email'),['placeholder'=>'Ingrese el correo','class'=>'form-control']) !!}
            
                                                           
                                                    </div>
                                                    <div class="col-md-6" >
            
                                                            <label>Contraseña:</label>
                                                            <input id="password" type="password" class="form-control" name="password">
            
                                                           
                                                            
                                                    </div>
                                                </div>
                                         
                                            
            
                                            
                                              
                                    </div>
                                    
            
                                
            
            
                                </div>
                            </div>
                        </div>

                        <div class="row">

                                <div class="col-md-4">

                        </div>

                        <div class="col-md-4">
                                {!! Form::submit('Actualizar',['class'=>'btn btn-primary btn-block']) !!}
        
        
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

    <script src="{{url('registrados/js/validaNumerosLetras.js')}}"></script>

    <script>
            function changeProfile() {
                $('#file').click();
            }
            $('#file').change(function () {
                if ($(this).val() != '') {
                    upload(this);
        
                }
            });
            function upload(img) {
                var form_data = new FormData();
                form_data.append('file', img.files[0]);
                form_data.append('_token', '{{csrf_token()}}');
                $('#loading').css('display', 'block');
                $.ajax({
                    url: "{{url('ajax-image-upload')}}",
                    data: form_data,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.fail) {
                            $('#preview_image').attr('src', '{{asset('images/no-avatar.png')}}');
                            alert(data.errors['file']);
                        }
                        else {
                            $('#file_name').val(data);
                            $('#preview_image').attr('src', '{{asset('images')}}/' + data);
                        }
                        $('#loading').css('display', 'none');
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                        $('#preview_image').attr('src', '{{asset('images/no-avatar.png')}}');
                    }
                });
            }
    
        </script>
    
    <script>

$('select').each(function(){
  var $this = $(this), numberOfOptions = $(this).children('option').length;

  $this.addClass('select-hidden'); 
  $this.wrap('<div class="select"></div>');
  $this.after('<div class="select-styled"></div>');

  var $styledSelect = $this.next('div.select-styled');
  $styledSelect.text($this.children('option').eq(0).text());

  var $list = $('<ul />', {
      'class': 'select-options'
  }).insertAfter($styledSelect);

  for (var i = 0; i < numberOfOptions; i++) {
      $('<li />', {
          text: $this.children('option').eq(i).text(),
          rel: $this.children('option').eq(i).val()
      }).appendTo($list);
  }

  var $listItems = $list.children('li');

  $styledSelect.click(function(e) {
      e.stopPropagation();
      $('div.select-styled.active').not(this).each(function(){
          $(this).removeClass('active').next('ul.select-options').hide();
      });
      $(this).toggleClass('active').next('ul.select-options').toggle();
  });

  $listItems.click(function(e) {
      e.stopPropagation();
      $styledSelect.text($(this).text()).removeClass('active');
      $this.val($(this).attr('rel'));
      $list.hide();
      //console.log($this.val());
  });

  $(document).click(function() {
      $styledSelect.removeClass('active');
      $list.hide();
  });

});


    </script>

@endsection