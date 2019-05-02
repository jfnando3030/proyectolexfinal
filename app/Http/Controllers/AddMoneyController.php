<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Pagos;
use App\Tarifa;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Log;


class AddMoneyController extends Controller
{
    private $_api_context;

    public $_id_tarifa;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {
        return view('paywithpaypal');
    }

    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {
        $tarifa = Tarifa::findOrFail($request->rbp); 

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

    	$item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($tarifa->precio); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($tarifa->precio);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($tarifa->id);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                //\Session::put('error','Connection timeout');
                Session::flash('flash_message', 'El tiempo de conexión expiro' );
                return Redirect::route('administracion/pago/registrar');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                //\Session::put('error','Some error occur, sorry for inconvenient');
                Session::flash('flash_message', 'Ha ocurrido un error, disculpe las molestias.' );
                return Redirect::route('administracion/pago/registrar');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        //\Session::put('error','Unknown error occurred');
        Session::flash('flash_message', 'Ha ocurrido un error desconocido.' );
    	return Redirect::route('administracion/pago/registrar');
    }

    public function getPaymentStatus(Request $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            //\Session::put('error','Payment failed');
            Session::flash('flash_message', 'Tu pago no se ha realizado.' );
            //return Redirect::route('administracion/pago/registrar');
            return redirect('administracion/pago/registrar');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/

            //\Session::put('success','Payment success');

            $date = Carbon::now();
            $hoy = $date->format('Y-m-d');
            $finalizacion = $this->aumentar_dias_activacion(Carbon::parse($hoy));

            //$tarifa1 = Tarifa::findOrFail($request->rbp); 

             $pago_consulta = Pagos::where('id_user', $request->user()->id)->where('activo', 1)->orWhere('activo', 0)->get();

              if (count($pago_consulta) > 0){
                $pago_consulta[0]->activo = 2;
                $pago_consulta[0]->estado = 0;

                $pago_consulta[0]->save();
              }

            DB::insert('insert into pagos (id_user, id_tarifa, fecha_inicio, fecha_finalizacion, modo_pago, monto_pago, activo, estado, comprobante_pago, path) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->user()->id, $payment->transactions[0]->description, $hoy, $finalizacion, 'P', $payment->transactions[0]->amount->total , '1', '1', 'Ninguno', 'Ninguno']);
            
            $date = Carbon::now();
                $hoy = $date->format('Y-m-d');
                $hora = $date->format('H:i:s');

                $ip_navegador= $request['ip_valor']. ' - ' .$request['navegador'];

                Log::create([
                    'fecha_log' => $hoy,
                    'hora_log' => $hora,
                    'estado' => 1,
                    'id_user_log' => $request->user()->id,
                    'ip' =>  $ip_navegador,
                    'accion' => "Realizó un pago por paypal",
                                

                
                ]);
            return redirect('administracion/pago/registrar')->with('mensaje-registro', 'Los datos se han guardado satisfactoriamente.');

            //Session::flash('flash_message', 'Tu pago ha sido exitoso.' );
            //return Redirect::route('/pago/registrar/nuevo2');
        }
        //\Session::put('error','Payment failed');
        Session::flash('flash_message', 'Pago fallido.' );
		return Redirect::route('administracion/pago/registrar');
    }

    public function aumentar_dias_activacion($fecha)
    {
      $nuevafecha = $fecha->addDay(30);
      return $nuevafecha;
    }

}