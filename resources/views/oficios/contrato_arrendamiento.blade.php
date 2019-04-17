<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <link rel="icon" href="{{ asset('frontend/images/icon.png') }}">
    <title>Procuración Judicial</title>
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
        <div align="center"><h3><b><u>u6bCONTRATO DE ARRENDAMIENTO.</u></b></h3></div>

        <p>En el cantón de {{$ciudad}}, Provincia de {{$provincia}}; el primer día del mes de octubre del año 2018, 
        se procede a celebrar el presente CONTRATO DE ARRENDAMIENTO al tenor de las siguientes clausulas:</p><br>
        <p><b>PRIMERO: INTERVINIENTES.-</b></p>
        <p>Intervienen en la celebración de este CONTRATO DE ARRENDAMIENTO, los siguientes ciudadanos:</p><br>

        <p><ol type="a"><li>Por una parte, el Señor <b>{{$arrendador_nombre}}</b>, portador de la cédula de ciudadanía <b>{{$arrendador_cedula}}</b>, 
            domiciliado en {{$arrendador_direccion}}, quien en adelante se la denominará <b>ARRENDADOR;</b> y,</li>
            <li>Por otra parte, la Señora <b>{{$arrendatario_nombre}},</b> portadora de la cédula de ciudadanía <b>{{$arrendatario_cedula}}</b>, 
            domiciliada  {{$arrendatario_direccion}}, cantón {{$ciudad}}; Provincia de {{$provincia}}, a quien en adelante se la denominará <b>ARRENDATARIO</b>.</li>
            </ol></p>

        
        <p>Los intervinientes aceptan libre y voluntariamente, sin presión de ninguna naturaleza, siendo voluntad de las partes el poder suscribir 
        este <b>CONTRATO DE ARRENDAMIENTO</b>, en los términos que se estipulan a continuación.</p><br>

        <b>SEGUNDO: ANTECEDENTES.- </b>
        <p>El Señor <b>{{$arrendador_nombre}}</b>, es propietario de un local comercial ubicado en {{$local_direccion}}, 
        de la ciudad de {{$local_ciudad}}, Provincia de {{$local_provincia}}; {{$local_antecedentes}}.</p><br>

        <p><b>TERCERA: OBJETO.-</b> Con tales antecedentes "El Arrendador" por sus propios derechos, da en arrendamiento a favor del "Arrendatario" 
        el local descrito en la cláusula anterior. Aclarando que el local se encuentra en perfecto estado.</p><br>

        <p><b>CUARTA: DESTINACIÓN DEL LOCAL.-</b> El Inmueble en arriendo será destinado como Mini-Market, tienda de abarrotes, entre otras actividades afines. 
        <b>NO SERÁ UTILIZADO PARA OTRA ACTIVIDAD QUE EL CONVENIDO.</b> Se prohíbe la introducción de materiales inflamables u otros artículos o sustancias 
        que pueden poner en peligro la seguridad del inmueble. </p><br>

        <p><b>QUINTA: PRECIO.-</b> El canon del arrendamiento se lo fija en la suma de (${{$local_precio_n}}) {{$local_precio_l}} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA <b>{{$local_periodo}}</b>, 
        el cual será cancelado cada diez ({{$local_intervalo}}) de cada mes, en EFECTIVO. El consumo del Fluido Eléctrico y de agua potable será pagado por el Arrendatario.</p><br>

        <p><b>SEXTA: PLAZO.-</b> El plazo de duración de este contrato será de <b>{{$duracion}} AÑO</b> calendario para ambas partes, contado desde la fecha de la suscripción del presente contrato, 
        el mismo que se podrá renovar cada año, siempre que las partes de común acuerdo lo hagan, suscribiendo una solicitud por escrito de su intención de continuar con 
        el presente contrato,</p><br>

        <p><b>SEPTIMA: GARANTIA:</b> El arrendatario entregó al arrendador, la cantidad de {{$local_garantia_l}} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA ($ {{$local_garantia_n}}), 
        por concepto de garantía, valor que será devuelto a la finalización del presente contrato siempre; y, cuando el bien arrendado no presente ningún deterioro, 
        falta de pago en el consumo del fluido eléctrico o de agua potable; y, se encuentre al día en sus cuotas mensuales por concepto del Arrendamiento.</p><br>

        <p><b>OCTAVA: SUBARRENDAMIENTO.-</b> Se prohíbe a La Arrendataria subarrendar o ceder a cualquier título los derechos que le correspondan por este contrato.</p><br>

        <p><b>NOVENA: CAUSAS DE TERMINACIÓN DEL CONTRATO ANTES DEL VENCIMIENTO DEL PLAZO.-</b> El arrendador podrá dar por terminado este contrato antes del vencimiento del plazo, 
        además de las causales que contempla la actual ley de Inquilinato, por las siguientes razones:</p><br>

        a) Falta de pago de una mensualidad;<br>
        b) Modificación de la vivienda sin permiso del arrendador; <br>
        c) Cambio de destinación de la vivienda;<br>
        d) Subarrendamiento u otro modo de cesión de derecho;  <br>
        e) Infringir la prohibición de introducir materiales que pongan en peligro el inmueble; <br>
        f) Por voluntad o decisión unilateral del Arrendador; y,<br>
        g) Por así convenir más a las partes.<br><br><br>

        <p><b>DÉCIMA: CLÁUSULA ESPECIAL.-</b> El Arrendador podrá solicitar a la Arrendataria que desocupe el local, con un lapso de tiempo de tres (3) meses de anticipación, 
        con el fin de que el Arrendatario pueda buscar otro local comercial donde pueda desempeñar su actividad comercial.</p><br>

        <p><b>UNDÉCIMA: MEJORAS.-</b> La arrendataria, no podrá realizar ninguna mejora en el local comercial arrendado, sin la autorización expresa; y, 
        por escrito por parte del Arrendador, documento que pasará a forma parte integral del presente contrato.</p><br>

        <p><b>DUODÉCIMA: TERMINACIÓN DEL CONTRATO VENCIDO EL PLAZO.-</b> El ARRENDADOR, deberá comunicar a la ARRENDATARIA, su deseo de no renovar dicho contrato, 
        por medio desahucio notificado legalmente por lo menos NOVENTA (90) DÍAS, de anticipación a la terminación del contrato de arrendamiento; de igual 
        modo la ARRENDATARIA comunicará su deseo de no renovar el contrato mediante desahucio notificado legalmente por lo menos NOVENTA (90) DÍAS, de 
        anticipación a la terminación del mismo.</p><br>

        <p><b>DÉCIMA TERCERA: JURISDICCIÓN Y COMPETENCIA.-</b> En todo lo que no se halle previsto en el presente contrato, las partes declaran incorporadas las disposiciones 
        legales de la Ley de Inquilinato vigentes.</p><br>

        <p>En caso de una de las cláusulas estipuladas en este contrato, las partes renuncian a sus domicilios; y, se someten a los jueces de la Unidad Judicial Multicompetente 
        del cantón Santa Rosa, Provincia de El Oro.</p><br>

        <p>Para constancia de lo actuado, las partes suscriben el presente contrato, en dos ejemplares iguales en este cantón de Santa Rosa, Provincia de El Oro, 
        el primer día del mes de octubre del año 2018.</p><br><br><br>




        <p class="firmas">
            {{-- _________________________<br> --}}
        <u>{{$arrendador_nombre}}</u><br>
                <b>C.C.</b> {{$arrendador_cedula}}<br>
                <b>ARRENDADOR.</b></p><br><br><br>





        <p class="firmas">
            <u>{{$arrendatario_nombre}}</u><br>
                <b>C.C.</b> {{$arrendatario_cedula}}<br>
                <b>ARRENDATARIO.</b></p>
    </section>

    
</body>
</html>