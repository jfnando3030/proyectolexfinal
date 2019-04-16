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
            margin: 25.000mm 30.000mm 25.000mm 30.000mm;
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
            <p>“<b>SEÑOR NOTARIO/A:</b> En el protocolo de escrituras públicas a su cargo, sírvase incorporar una por la cual conste PROCURACIÓN JUDICIAL, 
                en el que se otorga al tenor de las siguientes cláusulas y estipulaciones:</p>
            <p><b>PRIMERA: COMPARECIENTE.-</b> Comparece al otorgamiento de la presente escritura pública de <b>PROCURACIÓN JUDICIAL</b>, 
            el ciudadano <b>{{$nombre}}</b>, portador de la cédula de ciudadanía número 
            (En letras. Ejemplo: cero-siete-cero-cuatro-siete-tres-siete-siete-siete-cuatro) <b>{{$cedula}}</b>, <b>{{$edad}}</b> años de edad, <b>{{$estadocivil}}</b>, <b>{{$ocupacion}}</b>, 
            domiciliado en <b>{{$direccion}}</b>, en el cantón <b>{{$canton}}</b>, Provincia de <b>{{$provincia}}</b>; y, con número de teléfono celular <b>{{$telefono}}</b>; 
            a quien en lo posterior se podrá denominar como <b>PODERDANTE</b>, hábil en derecho para contratar y contraer obligaciones.</p>
            <p><b>SEGUNDO: PROCURACION JUDICIAL.-</b> Por medio del presente instrumento público, el ciudadano <b>{{$nombre}}</b>; de manera libre y voluntaria 
            confiere <B>PROCURACIÓN JUDICIAL</B>, amplio y suficiente cual en derecho se requiere a favor del Doctor <b>WILSON YOVANNY MERINO SÁNCHEZ</b>, portador 
            de la cedula de ciudadanía número cero siete cero dos seis cero cuatro nueve cero uno, con matricula número  cero siete – dos mil uno – cuarenta y siete, 
            del Foro de Abogados del Ecuador, mayor de edad, de estado civil casado, Doctor en Jurisprudencia, domiciliado en
             las calles Rocafuerte entre Guayas y Nueve de Mayo; en esta ciudad de Machala, Provincia de El Oro; además, al Abogado <b>ROMMEL RICARDO LEÓN CRESPO</b>,  
             portador de la cedula de ciudadanía número cero siete cero seis tres seis tres cinco tres ocho, 
             con matricula número cero siete – dos mil diecisiete – ciento cuarenta y seis, del Foro de Abogados de El Oro, mayor de edad, de estado civil soltero, 
             de profesión abogado, domiciliado en la Ciudadela El Bosque, sector Dos, en esta ciudad de Machala, Provincia de El Oro; y, a la 
             Abogada <b>JENNIFFER ADRIANA ÁLVAREZ CARRIÓN</b>, portador de la cedula de ciudadanía número cero siete cero cinco ocho cuatro cinco uno nueve seis, 
             con matrícula número cero siete – dos mil diecisiete – treinta y nueve, del Foro de Abogados de El Oro, mayor de edad, de estado civil soltero, 
             de profesión abogado, domiciliado en la Ciudadela Ocho de Noviembre, en esta ciudad de Machala, Provincia de El Oro; para que en forma individual 
            o conjunta en su nombre lo representen dentro del procedimiento de <b>{{$procedimiento}}</b>, con número (<b>{{$causa_letra}}</b>) (<b>{{$causa_numero}}</b>); y, que se 
            tramita en (<b>{{$nombre_uji}}</b>), con sede en el cantón <b>{{$canton_uji}}</b> , Provincia de <b>{{$provincia_uji}}</b>; por medio del <b>{{$juez_funcionario}}</b>. A su vez, manifiesto que dejo facultad y autorizo para que comparezcan a la audiencia única, formule prueba, presente alegatos, 
             reproche los argumentos de la contraparte, quedando facultados para conciliar y llegar acuerdos contractuales siempre que vayan acorde con mi escuálida economía.</p>
             <p><b>TERCERO: CLÁUSULA ESPECIAL.-</b> Los PROCURADORES JUDICIALES podrán sustituir esta Procuración a favor de otro profesional, allanarse a la demanda, transigir, 
            desistir de la acción o del recurso, aprobar convenios, absolver posiciones, deferir al juramento decisorio, recibir valores o la cosa sobre la cual
             verse el litigio o tomar posesión de ella. Otorgo las facultades establecidas en el  cuarenta y tres, del Código Orgánico General de Procesos; 
             en fin dentro de la Procuración Judicial otorgo todas las facultades en forma amplia y suficiente a fin que nadie pueda alegar insuficiencia del mismo.- </p>
             <p>Sírvase usted señor Notario agregar las demás formalidades de estilo, para la perfecta validez de este Instrumento Público.</p>
    </section>

    
</body>
</html>