<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class OficioController extends Controller
{
    public $datos;
    public $periodos = array(
        ""=>"Seleccione un periodo", "Mensuales"=>"Mensuales","Trimestrales"=>"Trimestrales", "Semestrales"=>"Semestrales", "Anuales"=>"Anuales");
    public $estado_civil = array(""=>"Seleccione el estado civil", "Casado/a"=>"Casado/a", "Divorciado/a"=>"Divorciado/a", "Soltero/a"=>"Soltero/a", "Viudo/a"=>"Viudo/a");
    public $contratos = array(""=>"Seleccione un tipo de contrato", 1=>"Contrato de Arrendamiento", 2=>"Procuración Judicial",
    3=>"Contrato de Prestación de Servicios Profesionales", 4=>"Contrato de Prestación de Servicios Profesionales de Perito Acreditado por el Consejo de la Judicatura");
    public $provincias = array(
        ""=>"Seleccione una provincia",
        1=>"Azuay",
        2=>"Bolívar",
        3=>"Cañar",
        4=>"Carchi",
        5=>"Chimborazo",
        6=>"Cotopaxi",
        7=>"El Oro",
        8=>"Esmeraldas",
        9=>"Galápagos",
        10=>"Guayas",
        11=>"Imbabura",
        12=>"Loja",
        13=>"Los Ríos",
        14=>"Manabí",
        15=>"Morona Santiago",
        16=>"Napo",
        17=>"Orellana",
        18=>"Pastaza",
        19=>"Pichincha",
        20=>"Santa Elena",
        21=>"Santo Domingo de los Tsáchilas",
        22=>"Sucumbíos",
        23=>"Tungurahua",
        24=>"Zamora Chinchipe");

    public $ciudades = array(
        ""=>"Seleccione una ciudad",
        // AZUAY
        1=>"Cuenca",
        2=>"Girón",
        3=>"Gualaceo",
        4=>"Nabon",
        5=>"Paute",
        6=>"Pucara",
        7=>"San Fernando",
        8=>"Santa Isabel",
        9=>"Sigsig",
        // BOLIVAR
        10=>"Caluma",
        11=>"Chillanes",
        12=>"Echeandía",
        13=>"Guaranda",
        14=>"La Asunción",
        // CAÑAR
        15=>"Azogues",
        16=>"Biblian",
        17=>"Cañar",
        18=>"La Troncal",
        // CARCHI
        19=>"Bolívar",
        20=>"El Angel",
        21=>"Huaca",
        22=>"Julio Andrade",
        23=>"La Paz",
        24=>"Mira",
        25=>"San Gabriel",
        26=>"Tulcán",
        // CHIMBORAZO
        27=>"Alausi",
        28=>"Cajabamba",
        29=>"Chambo",
        30=>"Chunchi",
        31=>"Colta",
        32=>"Cumandá",
        33=>"Guamote",
        34=>"Guano",
        35=>"Huigra",
        36=>"Pallatanga",
        37=>"Penipe",
        38=>"Riobamba",
        39=>"San Andrés",
        40=>"San Juan",
        // COTOPAXI
        41=>"Chantillin",
        42=>"El Corazón",
        43=>"Guaytacama",
        44=>"La Mana",
        45=>"Lasso",
        46=>"Latacunga",
        47=>"Mulalo",
        48=>"Pastocalle",
        49=>"Poalo",
        50=>"Pujili",
        51=>"Salcedo",
        52=>"Saquisili",
        53=>"Sigchos",
        54=>"Tanicuchi",
        55=>"Toacaso",
        // EL ORO
        56=>"Arenillas",
        57=>"Atahualpa",
        58=>"Balsas",
        59=>"Chilla",
        60=>"El Guabo",
        61=>"Huaquillas",
        62=>"Machala",
        63=>"Marcabeli",
        64=>"Pasaje",
        65=>"Piñas",
        66=>"Portovelo",
        67=>"Puerto Bolivar",
        68=>"Santa Rosa",
        69=>"Zaruma",
        // ESMERALDAS
        70=>"Atacames",
        71=>"Borbón",
        72=>"Eloy Alfaro",
        73=>"Esmeraldas",
        74=>"La Concordia",
        75=>"La Independencia",
        76=>"La Unión",
        77=>"Limones",
        78=>"Muisne",
        79=>"Quininde",
        80=>"Rioverde",
        81=>"Same Casablanca",
        82=>"San Lorenzo",
        83=>"Sua",
        84=>"Tonchigüé",
        85=>"Tonsupa",
        // GALAPAGOS
        86=>"Isabela",
        87=>"Puerto Ayora",
        88=>"Puerto Baquerizo Moreno",
        89=>"Santa Cruz",
        // GUAYAS
        90=>"Alf. Baquer. Moreno",
        100=>"Ancon",
        101=>"Balao",
        102=>"Balzar",
        102=>"Colimes",
        104=>"Daule",
        105=>"Duran",
        106=>"El Empalme",
        107=>"El Triunfo",
        108=>"Guayaquil",
        109=>"Milagro",
        110=>"Naranjal",
        111=>"Naranjito",
        112=>"Palestina",
        113=>"Pedro Carbo",
        114=>"Playas",
        115=>"Samborondon",
        116=>"Santa Lucia",
        117=>"Taura",
        118=>"Urbina Jado",
        119=>"Yaguachi",
        // IMBABURA
        120=>"Ambuqui",
        121=>"Atuntaqui",
        122=>"Cotacachi",
        123=>"Ibarra",
        124=>"Otavalo",
        125=>"Pimampiro",
        126=>"San Antonio De Ibarra",
        127=>"San Miguel De Urcuqui",
        128=>"San Pablo",
        129=>"Tumbabiro",
        // LOJA
        130=>"Alamor",
        131=>"Cariamanga",
        132=>"Catacocha",
        133=>"Catamayo",
        134=>"Celica",
        135=>"Chaguarpamba",
        136=>"Espindola",
        137=>"Gonzanama",
        138=>"Loja",
        139=>"Macara",
        140=>"Pindal",
        141=>"Quilanga",
        142=>"Saraguro",
        143=>"Sozoranga",
        144=>"Zapotillo",
        // LOS RIOS
        145=>"Baba",
        146=>"Babahoyo",
        147=>"Buena Fe",
        148=>"Catarama",
        149=>"Montalvo",
        150=>"Puebloviejo",
        151=>"Quevedo",
        152=>"Valencia",
        153=>"Ventanas",
        154=>"Vinces",
        // MANABI
        155=>"Bahia De Caraquez",
        156=>"Calceta",
        157=>"Chone",
        158=>"El Carmen",
        159=>"Flavio Alfaro",
        160=>"Jama",
        161=>"Jipijapa",
        162=>"Junin",
        163=>"Manta",
        164=>"Montecristi",
        165=>"Pajan",
        166=>"Pedernales",
        167=>"Pichincha",
        168=>"Portoviejo",
        169=>"Puerto Lopez",
        170=>"Rocafuerte",
        171=>"San Vicente",
        172=>"Santa Ana",
        173=>"Tosagua",
        174=>"Veinticuatro De Mayo",
        // MORONA SANTIAGO
        175=>"Gualaquiza",
        176=>"Limon Indanza",
        177=>"Macas",
        178=>"Santiago",
        179=>"Sucua",
        // NAPO
        180=>"Archidona",
        181=>"Baeza",
        182=>"Carlos Julio Arosemena Tola",
        183=>"El Chaco",
        184=>"Tena",
        // ORELLANA
        185=>"Francisco De Orellana",
        186=>"La Joya De Los Sachas",
        187=>"Loreto",
        188=>"Nuevo Rocafuerte",
        // PASTAZA
        189=>"Arajuno",
        190=>"Mera",
        191=>"Palora",
        192=>"Puyo",
        193=>"Santa Clara",
        194=>"Shell",
        // PICHINCHA
        195=>"Alangasi",
        196=>"Aloag",
        197=>"Amaguaña",
        198=>"Calderon",
        199=>"Cayambe",
        200=>"Conocoto",
        201=>"Cumbaya",
        202=>"El Coca",
        203=>"El Quinche",
        204=>"Guayllabamba",
        205=>"La Merced",
        206=>"Machachi",
        207=>"Mindo",
        208=>"Nayon",
        209=>"Pedro Vicente Maldonado",
        210=>"Pifo",
        211=>"Pintag",
        212=>"Pomasqui",
        213=>"Puembo",
        214=>"Puerto Quito",
        215=>"Pusuqui",
        216=>"Quito",
        217=>"San Antonio De Pichincha",
        218=>"San Miguel De Los Bancos",
        219=>"San Rafael",
        220=>"Sangolquí",
        221=>"Santo Domingo de los Colorados",
        222=>"Tababela",
        223=>"Tabacundo",
        224=>"Tambillo",
        225=>"Tumbaco",
        226=>"Yaruqui",
        // SANTA ELENA
        227=>"La Libertad",
        228=>"Salinas",
        229=>"Santa Elena",
        // SANTO DOMINGO DE LOS TSÁCHILAS
        230=>"Alluriquin",
        231=>"Luz De América",
        232=>"Santo Domingo",
        233=>"Valle Hermoso",
        // SUCUMBIOS
        234=>"Cascales",
        235=>"Cuyabeno",
        236=>"Gonzalo Pizarro",
        237=>"Lago Agrio",
        238=>"Nueva Loja",
        239=>"Putumayo",
        240=>"Shushufindi",
        241=>"Sucumbios",
        // TUNGURAHUA
        242=>"Ambato",
        243=>"Baños",
        244=>"Cevallos",
        245=>"Izamba",
        246=>"Mocha",
        247=>"Patate",
        248=>"Pelileo",
        249=>"Pillaro",
        250=>"Quero",
        251=>"Quisapincha",
        252=>"Tisaleo",
        // ZAMORA CHINCHIPE
        253=>"Chinchipe",
        254=>"Nangaritza",
        255=>"Yacuambi",
        256=>"Yantzaza",
        257=>"Zamora"
    );

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('oficios.create', ['provincias'=>$this->provincias, 'ciudades'=>$this->ciudades, 'contratos'=>$this->contratos, 'estado_civil'=>$this->estado_civil, 'periodos'=>$this->periodos ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ca(Request $request)
    {
        $datos = [            
            "fecha" => $request->oca_fecha,
            "provincia" => $this->provincias[$request->oca_pronvicia],
            "ciudad" => $this->ciudades[$request->oca_ciudad],
            "duracion" => $request->oca_duracion,
            "arrendador_cedula" => $request->ocaarrendador_cedula,
            "arrendador_nombre" => $request->ocaarrendador_nombre,
            "arrendador_direccion" => $request->ocaarrendador_direccion,
            "arrendatario_cedula" => $request->ocaarrendatario_cedula,
            "arrendatario_nombre" => $request->ocaarrendatario_nombre,
            "arrendatario_direccion" => $request->ocaarrendatario_direccion,
            "local_antecedentes" => $request->ocalocal_antecedentes,
            "local_destino" => $request->ocalocal_destino,
            "local_precio_n" => $request->ocalocal_precio_n,
            "local_precio_l" => $request->ocalocal_precio_l,
            "local_periodo" => $request->ocalocal_periodo,
            "local_intervalo" => $request->ocalocal_intervalo,
            "local_garantia_n" => $request->ocalocal_garantia_n,
            "local_garantia_l" => $request->ocalocal_garantia_l,
            "local_provincia" => $this->provincias[$request->ocalocal_provincia],
            "local_ciudad" => $this->ciudades[$request->ocalocal_ciudad],
            "local_direccion" => $request->ocalocal_direccion,
        ];



        $pdf = PDF::loadView('oficios.contrato_arrendamiento', $datos);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function pj(Request $request)
    {
        $datos = [
            "cedula" => $request->opj_cedula,
            "nombre" => $request->opj_nombre,
            "edad" => $request->opj_edad,
            "ocupacion" => $request->opj_ocupacion,
            "direccion" => $request->opj_direccion,
            "estadocivil" => $request->opj_estadocivil,
            "provincia" => $this->provincias[$request->opj_provincia],
            "canton" => $request->opj_canton,
            "telefono" => $request->opj_telefono,
            "procedimiento" => $request->opj_procedimiento,
            "causa_letra" => $request->opj_causa_l,
            "causa_numero" => $request->opj_causa_n,
            "nombre_uji" => $request->opj_uji,
            "canton_uji" => $request->opj_cantonuji,
            "provincia_uji" => $this->provincias[$request->opj_provinciauji],
            "juez_funcionario" => $request->opj_juez_funcionario   
        ];
        $pdf = PDF::loadView('oficios.procuracion_judicial', $datos);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function psppacj(Request $request)
    {
        $datos = [            
            "fecha" => explode('-', date('Y-F-d', strtotime($request->psppacj_fecha))),
            "provincia" => $this->provincias[$request->psppacj_provincia],
            "ciudad" => $this->ciudades[$request->psppacj_ciudad],
            "canton" => $request->psppacj_canton,
            "cliente_cedula" => $request->psppacjcliente_cedula,
            "cliente_nombre" => $request->psppacjcliente_nombre,
            "cliente_estado_civil" => $request->psppacjcliente_estado_civil,
            "cliente_provincia" => $this->provincias[$request->psppacjcliente_provincia],
            "cliente_canton" => $request->psppacjcliente_canton,
            "cliente_correo" => $request->psppacjcliente_correo,
            "cliente_motivo" => $request->psppacjcliente_motivo,
            "abogado_cedula" => $request->psppacjabogado_cedula,
            "abogado_nombre" => $request->psppacjabogado_nombre,
            "abogado_calidad" => $request->psppacjabogado_calidad,
            "abogado_mat_foro_abogados" => $request->psppacjabogado_mat_foro_abogados,
            "perito_cedula" => $request->psppacjperito_cedula,
            "perito_nombre" => $request->psppacjperito_nombre,
            "perito_area" => $request->psppacjperito_area,
            "perito_calificacion" => $request->psppacjperito_calificacion,
            "vfpago_honorario_l" => $request->psppacjvfpago_honorario_l,
            "vfpago_honorario_n" => $request->psppacjvfpago_honorario_n,
            "vfpago_cuota" => $request->psppacjvfpago_cuota,
            "domicilio" => $request->psppacj_domicilio,
            ];
    
            $pdf = PDF::loadView('oficios.contrato_psppacj', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
    }

    public function psp(Request $request)
    {
        $datos = [            
            "fecha" => explode('-', date('Y-F-d', strtotime($request->psp_fecha))),
            "provincia" => $this->provincias[$request->psp_provincia],
            "ciudad" => $this->ciudades[$request->psp_ciudad],
            "canton" => $request->psp_canton,
            "cliente_cedula" => $request->pspcliente_cedula,
            "cliente_nombre" => $request->pspcliente_nombre,
            "cliente_provincia" => $this->provincias[$request->pspcliente_provincia],
            "cliente_canton" => $request->pspcliente_canton,
            "cliente_correo" => $request->pspcliente_correo,
            "cliente_causa" => $request->pspcliente_causa,
            "cliente_telefono" => $request->pspcliente_telefono,
            "cliente_calidad" => $request->pspcliente_calidad,
            "cliente_direccion" => $request->pspcliente_direccion,
            "cliente_motivo" => $request->pspcliente_motivo,
            "abogado_cedula" => $request->pspabogado_cedula,
            "abogado_nombre" => $request->pspabogado_nombre,
            "abogado_calidad" => $request->pspabogado_calidad,
            "abogado_mat_foro_abogados" => $request->pspabogado_mat_foro_abogados,
            "vfpago_honorario_l" => $request->pspvfpago_honorario_l,
            "vfpago_honorario_n" => $request->pspvfpago_honorario_n,
            "vfpago_cuota" => $request->pspvfpago_cuota,
            "domicilio" => $request->psp_domicilio,
            ];
    
            $pdf = PDF::loadView('oficios.contrato_psp', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
    }
}
