<div class="table-responsive table--no-card m-b-30">
    <table id="example2" class="table table-borderless table-striped table-earning">
        <thead>
            <tr>
                
                
                <th>Usuario</th>

                <th>Fecha</th>

               
                <th>Hora</th>
                <th>IP</th>
                <th>Acción</th>

              
            </tr>
        </thead>
        <tbody>

            @foreach($logs as $log)
                @if($log->estado !=0)
                   <tr data-id="{{$log->id}}">
                
                
                       <td style="vertical-align:middle; font-size: 16px;">{{$log->usuario->nombres}} {{$log->usuario->apellidos}}</td>
                      

                       <td style="vertical-align:middle; font-size: 16px;">{{$log->fecha_log}} </td>
                       <td style="vertical-align:middle; font-size: 16px;">{{$log->hora_log}} </td>
                       <td style="vertical-align:middle; font-size: 16px;">{{$log->ip}} </td>
                       <td style="vertical-align:middle; font-size: 16px;">{{$log->accion}} </td>
                       
                   

                   </tr>

                  


                

                      

                               

                   @endif
               @endforeach

            
        </tbody>
    </table>

   

    {{ $logs->links('pagination') }}