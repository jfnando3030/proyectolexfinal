<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    {{-- <link rel="icon" href="{{ asset('frontend/images/icon.png') }}"> --}}
    <title>Contrato de Prestación de Servicios Profesionales de Perito Acreditado por el Consejo de la Judicatura</title>
    <style>
        @page {
                margin: 0cm 0cm;
            }
            
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2.5cm;

            /** Extra personal styles **/
            background-color: #1a73e8;
            color: white;
            text-align: center;
        }

        body{
            font-family: Arial, Helvetica, sans-serif;
            line-height: 0.50cm;
            margin: 30.000mm 30.000mm 25.000mm 30.000mm;
        }
        section{
            text-align: justify;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 2.5cm;

            /** Extra personal styles **/
            background-color: #1a73e8;
            color: white;
            text-align: center;
            line-height: 1.5cm;
        }
        .firmas{
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <br>
        <img src="{{url('images/logobangowhite.png')}}"   alt="Bango Energy Gel" /><br>
        MERINO & ASOCIADOS
    </header>
    <footer>MERINO & ASOCIADOS</footer>

    <section>
        <div align="center"><h3><b><u>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES DE PERITO ACREDITADO POR EL CONSEJO DE LA JUDICATURA.</u></b></h3></div><br>
    <p>En la ciudad de <b>{{$ciudad}}</b>, Provincia de <b>{{$provincia}}</b>, a los <b>{{$fecha[2]}}</b> días del mes de <b>{{$fecha[1]}}</b> del año <b>{{$fecha[0]}}</b>, 
        conste por el presente documento legal, un <b>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES DE PERITO ACREDITADO POR EL CONSEJO DE LA JUDICATURA,</b> 
        mismo que se celebrara al tenor de las cláusulas y declaraciones siguientes:</p>
        <br><p><b><u>PRIMERO. – INTERVINIENTES:</u></b></p><br>
        <p>Intervienen en la celebración de <b>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES DE PERITO ACREDITADO POR EL CONSEJO DE LA JUDICATURA</b>, las siguientes personas:</p>
 
        <ol type="a">
        <li>Por una parte, el Señor <b>{{$cliente_nombre}}</b>, ecuatoriano, portador de la cédula de ciudadanía No. <b>{{$cliente_cedula}}</b>, domiciliado en el cantón <b>{{$cliente_canton}}</b>, 
        provincia de <b>{{$cliente_provincia}}</b>, mayor de edad, de estado civil <b>{{$cliente_estado_civil}}</b>, correo electrónico <b>{{$cliente_correo}}</b>; a quien para efectos del presente contrato se le denominará 
            <b>EL CLIENTE</b>.</li>
        <li>Así mismo,  el <b>{{$abogado_nombre}}</b>, en su calidad de <b>{{$abogado_calidad}}</b> del Estudio Jurídico Merino & Asociados, ubicado en las calles Rocafuerte entre Guayas y Nueve
            de Mayo, Torre Corporativa Murano, oficinas 308-309, en esta ciudad de Machala, Provincia de El Oro, a quien para efectos del presente contrato se le 
            denominará <b>EL ABOGADO</b>.</li>
        <li>Y por otra parte, <b>{{$perito_nombre}}</b>, en su calidad de perito calificado dentro del Registro de la Función Judicial, en el Área de <b>{{$perito_area}}</b>, con número de 
        calificación <b>{{$perito_calificacion}}</b>; y, portador de la cédula de ciudadanía <b>{{$perito_cedula}}</b>, a quien para efectos del presente contrato se le denominará <b>EL PERITO</b></li>
        </ol><br>

    <p><b><u>SEGUNDO.-</u> EL CLIENTE</b> manifiesta que es deseo; y voluntad que <b>EL PERITO</b> realice la correspondiente <b>{{$cliente_motivo}}</b></p><br>
        
        <p><b>EL PERITO</b>, por su parte; manifiesta que cuenta con la preparación suficiente para desarrollar tal actividad.</p><br>
        
        <p>Que, <b>EL PERITO</b> declara bajo gravedad de juramento que no se encuentra incurso en ninguna de las causales de inhabilidad e incompatibilidad constitucional y legal.</p><br>
        
        <p>Los intervinientes aceptan libre y voluntariamente, sin presión de ninguna naturaleza, siendo voluntad de las partes el poder suscribir este 
        <b>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES DE PERITO ACREDITADO POR EL CONSEJO DE LA JUDICATURA</b>, en los términos que se estipulan a continuación.</p><br>
        
        <p><b><u>TERCERO.- OBJETO:</u> EL PERITO</b> se obliga para con <b>EL CLIENTE</b>, a prestar sus servicios profesionales, como <b>PERITO CALIFICADO POR EL REGISTRO DE LA FUNCIÓN JUDICIAL</b>, 
        en pleno ejercicio de sus funciones, para el asunto indicado en las consideraciones.</p><br>
        
        <p><b><u>CUARTO.- VALOR Y FORMA DE PAGO:</u></b><br><b>EL CLIENTE</b> pagará por concepto de honorarios la suma de <b>{{$vfpago_honorario_l}}</b> (<b>USD. {{$vfpago_honorario_n}}</b>), valor al cual se 
        encuentra incluido el impuesto al valor agregado (I.V.A); cancelando una cuota de entrada de <b>{{$vfpago_cuota}}</b> DE LOS ESTADOS UNIDOS DE NORTEAMÉRICA por la 
        realización de las actividades contratadas; y, el valor restante será pagado al momento de la entrega de la pericia.</p><br>
        
        <p>Adicional al pago por concepto de honorarios, <b>EL CLIENTE</b> pagará los valores entendidos por concepto de fotocopias. En caso de hacer diligencias relacionadas 
        con el asunto fuera de la provincia o en el exterior, los gastos, viáticos, hospedaje; y, alimentación serán entregados a <b>EL PERITO</b> antes de iniciar el viaje.</p><br>
        
        <p><b><u>QUINTO.- DURACIÓN:</u></b><br>
        El presente contrato tendrá una duración indefinida en el tiempo, a partir de la fecha de su firma.</p><br>
        
        <p><b><u>SEXTO.- EXCLUSIÓN DE LA RELACIÓN LABORAL:</u></b><br>
        Este contrato no constituye vinculación laboral alguna de <b>EL CLIENTE</b> con <b>EL PERITO.</b></p><br>
        
        <p><b><u>SÉPTIMO.- TERMINACIÓN ANTICIPADA:</u></b>
                La terminación anticipada de este contrato procede:<br>
                <ol type="a">
                    <li>Por mutuo acuerdo.</li>
                    <li>Por incumplimiento de las obligaciones pactadas; por una o ambas partes contratantes.</li>
                </ol></p><br>
        
        <p><b><u>OCTAVO.-  DOMICILIO.-</u></b><br>
        Para los efectos del acuerdo contenido en este documento, las partes señalan como domicilio <b>{{$domicilio}}</b>, y se someten a los Juzgadores de la Unidad Judicial 
        de lo Civil y Mercantil que allí ejercen jurisdicción.</p>
        
        <p>Para constancia y fe de lo actuado, las partes reconocen sus firmas y rubricas del presente documento en el cantón <b>{{$canton}}</b>, Provincia de <b>{{$provincia}}</b>, 
        a los <b>{{$fecha[2]}}</b> días del mes de <b>{{$fecha[1]}}</b> del año <b>{{$fecha[0]}}</b>.</p><br><br><br><br>

        <p class="firmas"><b>__________________________________</b><br>
        <b>{{$cliente_nombre}}</b><br>
        <b>C.C. {{$cliente_cedula}}</b><br>
        <b><u>EL CLIENTE.</u></b></p>



        <p class="firmas"><b>__________________________________</b><br>
        <b>{{$abogado_nombre}}</b><br>
        <b>C.C. {{$abogado_cedula}}</b><br>
        <b>MAT. FORO DE ABOGADOS: {{$abogado_mat_foro_abogados}} DEL ESTUDIO JURÍDICO MERINO & ASOCIADOS.</b><br>
        <b><u>EL ABOGADO.</u></b></p>



        <p class="firmas"><b>__________________________________</b><br>
        <b>{{$perito_nombre}}</b><br>
        <b>C.C. {{$perito_cedula}}</b><br>
        <b>No. de Calificación: {{$perito_calificacion}}</b><br>
        <b><u>PERITO CALIFICADO EN EL REGISTRO DE LA FUNCIÓN JUDICIAL</u></b></p>

    </section>

    
</body>
</html>