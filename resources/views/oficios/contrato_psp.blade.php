<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    {{-- <link rel="icon" href="{{ asset('frontend/images/icon.png') }}"> --}}
    <title>Contrato de Prestación de Servicios Profesionales</title>
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
        <div align="center"><h3><b><u>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES.</u></b></h3></div><br>
        <p>En la ciudad de <b>{{$ciudad}}</b>, Provincia de <b>{{$provincia}}</b>, a los <b>{{$fecha[2]}}</b> días del mes de <b>{{$fecha[1]}}</b> del año <b>{{$fecha[0]}}</b>, 
        conste por el presente documento legal, un <b>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES,</b> 
        mismo que se celebrara al tenor de las cláusulas y declaraciones siguientes:</p>
        <br><p><b><u>PRIMERA. – INTERVINIENTES:</u></b></p><br>
        <p>Intervienen en la celebración de est <b>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES</b>, las siguientes personas:</p>
 
        <ol type="a">
        <li>Por una parte, el Señor <b>{{$cliente_nombre}}</b>, portador de la cédula de ciudadanía <b>{{$cliente_cedula}}</b>, teléfono <b>{{$cliente_telefono}}</b>, 
        correo electrónico <b>{{$cliente_correo}}</b>, domiciliado <b>{{$cliente_direccion}}</b>, en el cantón <b>{{$cliente_canton}}</b>, 
        provincia de <b>{{$cliente_provincia}}</b>; obrando como <b>{{$cliente_calidad}}</b>; y, quien para efectos del mismo se denomina <b>EL CLIENTE</b>.</li>
        <li>Por otra parte, el Doctor en Jurisprudencia <b>WILSON YOVANNY MERINO SÁNCHEZ</b>, portador de la cédula de ciudadanía 070260490-1, 
        con Matrícula Foro de Abogados 07-2001-47; ecuatoriano, mayor de edad, casado, en su calidad de Presidente del Estudio Jurídico Merino & Asociados, 
        ubicado en las calles Rocafuerte entre Guayas y Nueve de Mayo, Torre Corporativa Murano, oficinas 308-309, en esta ciudad de Machala, Provincia de El Oro, 
        a quien para efectos del presente contrato se le denominará <b>EL ABOGADO.</b></li>
        {{-- <li>Así mismo,  el <b>{{$abogado_nombre}}</b>, en su calidad de <b>{{$abogado_calidad}}</b> del Estudio Jurídico Merino & Asociados, ubicado en las calles Rocafuerte entre Guayas y Nueve
            de Mayo, Torre Corporativa Murano, oficinas 308-309, en esta ciudad de Machala, Provincia de El Oro, a quien para efectos del presente contrato se le 
            denominará <b>EL ABOGADO</b>.</li> --}}
        </ol><br>

        <p><b><u>SEGUNDO.-</u> EL CLIENTE</b> manifiesta que es deseo; y voluntad que <b>EL ABOGADO</b> le redacte e imprima escritos; y, libelos, acuda a diligencias; 
        y, audiencias a fin de obtener la prueba, impulso o defensa técnica necesaria para la <b>ACCIÓN {{$cliente_motivo}}</b>, con relación a la causa <b>{{$cliente_causa}}</b>, 
        donde <b>EL CLIENTE</b> actuará como <b>LEGITIMADO ACTIVO.</b></p><br>

        <p>Que, para el asunto anteriormente descrito se requiere de un profesional en el Área del Derecho, para que ejerza sus funciones como tal.</p><br>
 
        <p><b>EL ABOGADO,</b> por su parte; manifiesta que cuenta con la preparación suficiente en el Área del Derecho, para desarrollar tal actividad.</p><br>
        
        <p>Que, <b>EL ABOGADO</b> declara bajo gravedad de juramento que no se encuentra incurso en ninguna de las causales de inhabilidad e incompatibilidad constitucional y legal.</p><br>
        
        <p>Los intervinientes aceptan libre y voluntariamente, sin presión de ninguna naturaleza, siendo voluntad de las partes el poder suscribir este 
        <b>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES</b>, en los términos que se estipulan a continuación.</p><br>
        
        <p><b><u>TERCERO.- OBJETO:</u> EL ABOGADO</b> se obliga para con <b>EL CLIENTE</b>, a prestar sus servicios profesionales, como 
        <b>ABOGADO TITULADO E INSCRITO EN EL FORO DE ABOGADOS DEL CONSEJO DE LA JUDICATURA DEL ECUADOR</b>, en pleno ejercicio de sus funciones, 
        para el asunto indicado en las consideraciones.</p><br>
        
        <p><b><u>CUARTO.- OBLIGACIONES GENERALES DEL ABOGADO:</u></b> Constituyen obligaciones de <b>EL ABOGADO</b>, las siguientes:</p><br>
        
        <ol type="a"><li>Cumplir con la prestación del servicio convenido.</li>
        <li>Para el desarrollo de la gestión <b>EL ABOGADO</b>, actuará en forma independiente y acorde con la disponibilidad que le exija el cumplimiento del contrato.</li>
        <li><b>EL ABOGADO,</b> conservando su autonomía e iniciativa en las gestiones profesionales y actividades encomendadas, respetará la Constitución de la República
        del Ecuador, aplicables al objeto de este contrato.</li>
        <li>Velará para que en forma eficiente, diligente y responsable atiendan las instituciones públicas, todas las actuaciones necesarias y dentro de los términos de ley.</li>
        <li>Comunicará en forma oportuna los documentos, fotocopias, pruebas y demás que deba entregar a <b>EL ABOGADO</b>, para el fiel cumplimiento de sus actividades encomendadas
        y contratadas.</li>
        <li>Mantener informado a <b>EL CLIENTE</b> de las actuaciones realizadas; y, de su presencia cuando hubiere tal urgencia.</li> 
        <li>Actuar en el proceso judicial hasta que la sentencia se encuentre definitivamente en firme, que se de en cualquier instancia, recurso, gestión, acompañamiento
        o diligencia judicial; o, extrajudicial que se explica en las consideraciones.</li>
        <li>Defender los intereses del CLIENTE en acciones colaterales que como producto de esta acción legal surjan.</li></ol><br>
        
        <p><b><u>QUINTO.- VALOR Y FORMA DE PAGO:</u></b></p><br>
        
        <p><b>EL CLIENTE</b> pagará por concepto de honorarios la suma de <b>{{$vfpago_honorario_l}} DÓLARES DE LOS ESTADOS UNIDOS DE NORTEAMÉRICA</b> (USD. {{$vfpago_honorario_n}}) más impuesto 
        al valor agregado (I.V.A); cancelando una cuota de entrada del <b>CINCUENTA POR CIENTO</b> (50%), por la realización de las actividades contratadas.</p><br>
        
        <p>Adicional al pago por concepto de honorarios, <b>EL CLIENTE</b> pagará los valores entendidos por concepto de fotocopias. En caso de hacer diligencias relacionadas 
        con el asunto fuera de la provincia o en el exterior, los gastos, viáticos, hospedaje; y, alimentación serán entregados a <b>EL ABOGADO</b> antes de iniciar el viaje.</p><br>
        
        <p>Todos los gastos, viáticos y honorarios que conlleva la realización de diligencias judiciales, peritajes, inspecciones judiciales, pruebas anticipadas, 
        apostillas de documentos y otros, serán a cargo de <b>EL CLIENTE.</b></p><br>
        
        <p><b><u>SEXTO.- DURACIÓN:</u></b><br>
        El presente contrato tendrá una duración indefinida en el tiempo, a partir de la fecha de su firma.</p><br>
        
        <p><b><u>SÉPTIMO.- EXCLUSIÓN DE LA RELACIÓN LABORAL:</u></b>
        Este contrato no constituye vinculación laboral alguna de <b>EL CLIENTE</b> con <b>EL ABOGADO.</b></p><br>
        
        <p><b><u>OCTAVO.- CLÁUSULA PENAL:</u></b><br>
        En caso de incumplimiento por parte de <b>EL CLIENTE,</b> ello será motivo suficiente para renuncia como apoderado o defensor técnico debidamente autorizado; y, 
        en consecuencia <b>EL CLIENTE</b> pagará a <b>EL ABOGADO</b> la suma equivalente al <b>CINCUENTA POR CIENTO (50%)</b> del valor del contrato; valor entendido que 
        podrá hacerse efectivo mediante juicio.</p><br>
        
        <p>NOVENO.- TERMINACIÓN ANTICIPADA:
        La terminación anticipada de este contrato procede:<br>
        <ol type="a"><li>Por mutuo acuerdo.</li>
        <li>Por incumplimiento de las obligaciones pactadas; por una o ambas partes contratantes.</li></ol></p><br>
        
        <p><b><u>DÉCIMO.- PERFECCIONAMIENTO:</u></b></p><br>
        <p>El presente contrato queda perfeccionado con la firma de este documento. Es válido lo escrito a mano en el texto.</p><br>
        
        <p>Una vez cancelados los valores en su totalidad por parte de <b>EL CLIENTE</b>; <b>EL ABOGADO</b> le remitirá una <b>FACTURA</b> por concepto del presente 
        <b>CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES.</b></p><br>
        
        <p><b><u>UNDÉCIMO.-  DOMICILIO.-</u></b></p><br>
        
        <p>Para los efectos del acuerdo contenido en este documento, las partes señalan como domicilio la ciudad de Machala, y se someten a los Juzgadores de la 
        Unidad Judicial de lo Civil y Mercantil que allí ejercen jurisdicción.</p><br>
        
        <p>Para constancia y fe de lo actuado, las partes reconocen sus firmas y rubricas del presente documento en la ciudad de Machala, Provincia de El Oro, 
        a los <b>{{$fecha[2]}}</b> días del mes de <b>{{$fecha[1]}}</b> del año <b>{{$fecha[0]}}</b></p><br><br><br>

        <p class="firmas"><b>__________________________________</b><br>
        <b>{{$cliente_nombre}}</b><br>
        <b>C.C. {{$cliente_cedula}}</b><br>
        <b>{{$cliente_calidad}}</b><br>
        <b><u>EL CLIENTE.</u></b></p><br><br><br>



        <p class="firmas"><b>__________________________________</b><br>
        <b>{{$abogado_nombre}}</b><br>
        <b>C.C. {{$abogado_cedula}}</b><br>
        <b>MAT. FORO DE ABOGADOS: 07-2201-47 PRESIDENTE DEL ESTUDIO JURÍDICO MERINO & ASOCIADOS.</b><br>
        <b><u>EL ABOGADO.</u></b></p>
    </section>

    
</body>
</html>