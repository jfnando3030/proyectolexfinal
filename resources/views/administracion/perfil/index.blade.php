@extends('layouts.administracion')

@section('contenido')

  
    <div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;">Mi Perfil </h4>

    </div>
  
 

  
<div class="container-fluid">

    @if (session('mensaje-registro'))
        @include('mensajes.msj_correcto')
    @endif
   
    <div class="emp-profile">
      
            <div class="row">
                <div class="col-sm-5 col-md-5 col-12 col-lg-4 col-xl-4" style="    padding-bottom: 15px;">
                    <div class="profile-img">
                        @if(Auth::user()->path!=null)
                           
                            <img src="{{url('images/'.Auth::user()->path)}}" class="user-image" alt="Mi Foto" id="preview_image" />
                       
                    
                        @else
                            
                                <img src="{{url('images/no-avatar.png')}}" class="user-image" alt="MI Foto" id="preview_image" />
                            
                            
                        @endif
                    </div>
                </div>
                <div class="col-sm-7 col-md-7 col-12 col-lg-8 col-xl-8">
                    <div class="profile-head">
                                <h5>
                                    {!! Auth::user()->nombres !!} {{Auth::user()->apellidos}}
                                </h5>
                                <h6 style="padding-bottom:15px;">
                                    Usuario Registrado
                                </h6>
                               

                    </div>

                    <div class="row">
                
                            <div class="col-md-12 col-12 col-xs-12- col-lg-12">

                                    <div class="row">
                                           
                                            <div class="col-md-6  col-12">
                                                    <label style="text-align:center; color: black;font-weight: bold;">Nombres:</label>
                                                     <span style="color: black;">{{Auth::user()->nombres}}</span>
                                              
                                                
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label style="text-align:center; color: black;font-weight: bold;">Apellidos:</label>
                                                <span style="color: black;">{{Auth::user()->apellidos}}</span>
                                            </div>
                                        </div>
                               
                                               
                                           <div class="row">

                                                <div class="col-md-6 col-12">
                                                        <label style="text-align:center; color: black;font-weight: bold;">Cédula:</label>
                                                        <span style="color: black;">{{Auth::user()->cedula}}</span>
                                                    </div>
                                               
                                                <div class="col-md-6  col-12">
                                                        <label style="text-align:center; color: black;font-weight: bold;">Email:</label>
                                                         <span style="color: black;">{{Auth::user()->email}}</span>
                                                  
                                                    
                                                </div>
                                            </div>

                                            <div class="row">
                                                  
                                                    <div class="col-md-12  col-12">
                                                            <label style="text-align:center; color: black;font-weight: bold;">Direccion:</label>
                                                            @if(Auth::user()->direccion!="")

                                                                  <span style="color: black;">{{Auth::user()->direccion}}</span>
                                                             

                                                                @else

                                                                <span style="color: black;">No ha ingresado su dirección</span>


                                                                @endif

                                                           
                                                            
                                                      
                                                        
                                                    </div>
                                                </div>

                                                <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <label style="text-align:center; color: black;font-weight: bold;">Telefono:</label>

                                                            @if(Auth::user()->telefono!="")

                                                                  <span style="color: black;">{{Auth::user()->telefono}}</span>
                                                             

                                                                @else

                                                                <span style="color: black;">No ha ingresado su teléfono</span>


                                                                @endif

                                                            
                                                        </div>
                                                        <div class="col-md-6  col-12">
                                                                <label style="text-align:center; color: black;font-weight: bold;">Celular:</label>

                                                                @if(Auth::user()->celular!="")

                                                                <span style="color: black;">{{Auth::user()->celular}}</span>
                                                           

                                                              @else

                                                              <span style="color: black;">No ha ingresado su # celular</span>


                                                              @endif

                                                              
                                                          
                                                            
                                                        </div>
                                                    </div>

                                                   


                                                       

                                                   

                                                        

                                                        <div class="row">

                                                            <div class="col-md-4">
                            
                                                         </div>
                            
                                                    <div class="col-md-4" style="padding-bottom: 15px; padding-left: 0; padding-right: 0;">
                                                        <a title="Editar Perfil" onclick="return myFunction();" class="btn btn-primary btn-block" href="{{ route('perfil.edit',['parameters' => Crypt::encrypt(Auth::user()->id)])}}" role="button">Editar perfil</a>
                                    
                                    
                                                    </div>
                            
                                                    <div class="col-md-4">
                            
                                                        </div>
                            
                                                </div>



                                                


                                        
                                                
                                             
                                    </div>
                                  
                         
            
            
                    </div>
                </div>
               
            </div>
     

                 
    </div>

</div>



  
 

    
@endsection