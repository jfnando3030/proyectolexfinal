@extends('layouts.administracion')

@section('contenido')

<div align="center" class="col-md-12 col-12 col-xs-12 col-lg-12 col-sm-12" style="padding-top:15px; padding-bottom: 25px">
        <h4 style="color: black; text-align:center; font-size:25px;"> Historial de mi ganancias </h4>
    </div>
  <div class="container-fluid">

    <div class="row">
        <div class="col-12  col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning" id="tabla">
                    <thead>
                        <tr>
                            <th>Monto de compra</th>
                            <th>Ganancia</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           <td style="vertical-align:middle; font-size: 16px;"> $ 150 </td>
                           <td style="vertical-align:middle; font-size: 16px;"> $ 15 </td>
                           <td style="vertical-align:middle; font-size: 16px;"> 17-03-2019 </td>
                       </tr>
                    </tbody>
                </table>
                <div class="statistic__item" style="display: none;" id="falta_datos">
                    <h2 class="number">Oh no!</h2>
                    <label style='color:#FA206A'>...No se ha encontrado ningún registro...</label>  
                    <div class="icon">
                        <i class="zmdi zmdi-mood-bad"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{url('administration/dist/js/roles/delete.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".aprobado").fadeOut(300);
            },3000);
        });
    </script>

      
@endsection