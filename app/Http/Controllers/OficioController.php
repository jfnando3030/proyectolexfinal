<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\OficioLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

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
        91=>"Ancon",
        92=>"Balao",
        93=>"Balzar",
        94=>"Colimes",
        95=>"Daule",
        96=>"Duran",
        97=>"El Empalme",
        98=>"El Triunfo",
        99=>"Guayaquil",
        100=>"Milagro",
        101=>"Naranjal",
        102=>"Naranjito",
        103=>"Palestina",
        104=>"Pedro Carbo",
        105=>"Playas",
        106=>"Samborondon",
        107=>"Santa Lucia",
        108=>"Taura",
        109=>"Urbina Jado",
        110=>"Yaguachi",
        // IMBABURA
        111=>"Ambuqui",
        112=>"Atuntaqui",
        113=>"Cotacachi",
        114=>"Ibarra",
        115=>"Otavalo",
        116=>"Pimampiro",
        117=>"San Antonio De Ibarra",
        118=>"San Miguel De Urcuqui",
        119=>"San Pablo",
        120=>"Tumbabiro",
        // LOJA
        121=>"Alamor",
        122=>"Cariamanga",
        123=>"Catacocha",
        124=>"Catamayo",
        125=>"Celica",
        126=>"Chaguarpamba",
        127=>"Espindola",
        128=>"Gonzanama",
        129=>"Loja",
        130=>"Macara",
        131=>"Pindal",
        132=>"Quilanga",
        133=>"Saraguro",
        134=>"Sozoranga",
        135=>"Zapotillo",
        // LOS RIOS
        136=>"Baba",
        137=>"Babahoyo",
        138=>"Buena Fe",
        139=>"Catarama",
        140=>"Montalvo",
        141=>"Puebloviejo",
        142=>"Quevedo",
        143=>"Valencia",
        144=>"Ventanas",
        145=>"Vinces",
        // MANABI
        145=>"Bahia De Caraquez",
        147=>"Calceta",
        148=>"Chone",
        149=>"El Carmen",
        150=>"Flavio Alfaro",
        151=>"Jama",
        152=>"Jipijapa",
        153=>"Junin",
        154=>"Manta",
        155=>"Montecristi",
        156=>"Pajan",
        157=>"Pedernales",
        158=>"Pichincha",
        159=>"Portoviejo",
        160=>"Puerto Lopez",
        161=>"Rocafuerte",
        162=>"San Vicente",
        163=>"Santa Ana",
        164=>"Tosagua",
        165=>"Veinticuatro De Mayo",
        // MORONA SANTIAGO
        166=>"Gualaquiza",
        167=>"Limon Indanza",
        168=>"Macas",
        169=>"Santiago",
        170=>"Sucua",
        // NAPO
        171=>"Archidona",
        172=>"Baeza",
        173=>"Carlos Julio Arosemena Tola",
        174=>"El Chaco",
        175=>"Tena",
        // ORELLANA
        176=>"Francisco De Orellana",
        177=>"La Joya De Los Sachas",
        178=>"Loreto",
        179=>"Nuevo Rocafuerte",
        // PASTAZA
        180=>"Arajuno",
        181=>"Mera",
        182=>"Palora",
        183=>"Puyo",
        184=>"Santa Clara",
        185=>"Shell",
        // PICHINCHA
        186=>"Alangasi",
        187=>"Aloag",
        188=>"Amaguaña",
        189=>"Calderon",
        190=>"Cayambe",
        191=>"Conocoto",
        192=>"Cumbaya",
        193=>"El Coca",
        194=>"El Quinche",
        195=>"Guayllabamba",
        196=>"La Merced",
        197=>"Machachi",
        198=>"Mindo",
        199=>"Nayon",
        200=>"Pedro Vicente Maldonado",
        201=>"Pifo",
        202=>"Pintag",
        203=>"Pomasqui",
        204=>"Puembo",
        205=>"Puerto Quito",
        206=>"Pusuqui",
        207=>"Quito",
        208=>"San Antonio De Pichincha",
        209=>"San Miguel De Los Bancos",
        210=>"San Rafael",
        211=>"Sangolquí",
        212=>"Santo Domingo de los Colorados",
        213=>"Tababela",
        214=>"Tabacundo",
        215=>"Tambillo",
        216=>"Tumbaco",
        217=>"Yaruqui",
        // SANTA ELENA
        218=>"La Libertad",
        219=>"Salinas",
        220=>"Santa Elena",
        // SANTO DOMINGO DE LOS TSÁCHILAS
        221=>"Alluriquin",
        222=>"Luz De América",
        223=>"Santo Domingo",
        224=>"Valle Hermoso",
        // SUCUMBIOS
        225=>"Cascales",
        226=>"Cuyabeno",
        227=>"Gonzalo Pizarro",
        228=>"Lago Agrio",
        229=>"Nueva Loja",
        230=>"Putumayo",
        231=>"Shushufindi",
        232=>"Sucumbios",
        // TUNGURAHUA
        233=>"Ambato",
        234=>"Baños",
        235=>"Cevallos",
        236=>"Izamba",
        237=>"Mocha",
        238=>"Patate",
        239=>"Pelileo",
        240=>"Pillaro",
        241=>"Quero",
        242=>"Quisapincha",
        243=>"Tisaleo",
        // ZAMORA CHINCHIPE
        244=>"Chinchipe",
        245=>"Nangaritza",
        246=>"Yacuambi",
        247=>"Yantzaza",
        248=>"Zamora"
    );


    public function index()
    {
        $oficios = DB::table('oficios_log')->orderBy('id')->paginate(5);
        return view('oficios.index', [ 'oficios' => $oficios]);
    }

    public function generarPdf($id)
    {
        $_id= Crypt::decrypt($id);
        $oficio = OficioLog::find($_id);
        $datos = json_decode($oficio->vista, true);

        if ($oficio->titulo_documento == $this->contratos[1]) {
            $pdf = PDF::loadView('oficios.contrato_arrendamiento', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }
        if ($oficio->titulo_documento == $this->contratos[2]) {
            $pdf = PDF::loadView('oficios.procuracion_judicial', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }
        if ($oficio->titulo_documento == $this->contratos[3]) {
            $pdf = PDF::loadView('oficios.contrato_psp', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }
        if ($oficio->titulo_documento == $this->contratos[4]) {
            $pdf = PDF::loadView('oficios.contrato_psppacj', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }
    }

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

        $usuario = $request->user()->nombres . " " . $request->user()->apellidos;

        if ($this->registrarLog($this->contratos[$request->oca_mo], $datos["fecha"], $usuario, json_encode($datos))) {
            $pdf = PDF::loadView('oficios.contrato_arrendamiento', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }
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

        $usuario = $request->user()->nombres . " " . $request->user()->apellidos;

        if ($this->registrarLog($this->contratos[$request->pj_mo], date('Y-m-d'), $usuario, json_encode($datos))) {
            $pdf = PDF::loadView('oficios.procuracion_judicial', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        } 
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

        $usuario = $request->user()->nombres . " " . $request->user()->apellidos;

        if ($this->registrarLog($this->contratos[$request->psppacj_mo], $request->psppacj_fecha, $usuario, json_encode($datos))) {
            $pdf = PDF::loadView('oficios.contrato_psppacj', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }
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

        $usuario = $request->user()->nombres . " " . $request->user()->apellidos;

        if ($this->registrarLog($this->contratos[$request->psp_mo], $request->psp_fecha, $usuario, json_encode($datos))) {
            $pdf = PDF::loadView('oficios.contrato_psp', $datos);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        } 
    }

    public function registrarLog($titulo, $fecha, $usuario, $datos)
    {
        $oficioLog = new OficioLog;
        $oficioLog->titulo_documento = $titulo;
        $oficioLog->fecha = $fecha;
        $oficioLog->usuario = $usuario;
        $oficioLog->vista = $datos;
        return $oficioLog->save();
    }
}
