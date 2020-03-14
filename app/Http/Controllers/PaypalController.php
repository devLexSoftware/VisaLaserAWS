<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
 
 
use App\Order;
use App\OrderItem;
use App\transactionTable;
use App\transactiondetail;


class PaypalController extends Controller
{
    //

    private $_api_context;
 
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['sandbox_client_id'], $paypal_conf['sandbox_secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    public function postPayment()
	{		
		//  return redirect()->route('registerComplete')->with('message', session('idUser'));

		$info = session('info');

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
 		
		$subtotal = 0;
		$cart = $info;
        $currency = 'MXN';
        
        // $cart = array(
        //     0 => array(
        //         'name'=>'otros',
        //         'extract'=>'null',
        //         'quantity'=>'1',
        //         'price'=>'20'
        //     )

        // );

        
		$item = new Item();
		$item->setName("producto")
		->setCurrency($currency)
		->setDescription("Descripcion")
		->setQuantity(1)
		->setPrice(1200);

		$items[] = $item;
		$subtotal = 1200;
		
 
		// foreach($cart as $producto){
		// 	$item = new Item();
        //     $item->setName($producto->name)
		// 	->setCurrency($currency)
		// 	->setDescription($producto->extract)
		// 	->setQuantity($producto->quantity)
		// 	->setPrice($producto->price);
 
		// 	$items[] = $item;
		// 	$subtotal += $producto->quantity * $producto->price;
		// }
 
		$item_list = new ItemList();
		$item_list->setItems($items);
 
		$details = new Details();
		$details->setSubtotal($subtotal)
		->setShipping(100);
 
		$total = $subtotal + 100;
 
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);
 
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Pedido de prueba en mi Laravel App Store');
 
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));
 
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
 
		try {
			$payment->create($this->_api_context);
		} 
		catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} 
			else {
				die('Ups! Algo salió mal');
			}
		}
 
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
 
		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
 
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
 
		return \Redirect::route('cart-show')
			->with('message', 'Ups! Error desconocido.');
 
    }
    
    public function getPaymentStatus(Request $request)
	{
		// // Get the payment ID before session clear
		// $payment_id = $request->get('paymentId');//\Session::get('paypal_payment_id');
 
		// // clear the session payment ID
		// \Session::forget('paypal_payment_id');
 
		// $payerId = $request->get('PayerID');//\Input::get('PayerID');
		// $token = $request->get('token');//\Input::get('token');
 
		// if (empty($payerId) || empty($token)) {
		// 	return \Redirect::route('registerComplete')
		// 		 ->with('message', 'Hubo un problema al intentar pagar con Paypal');
		// }
 
		// $payment = Payment::get($payment_id, $this->_api_context);
 
		// $execution = new PaymentExecution();
		// $execution->setPayerId($request->get('payerID'));
 
		// $result = $payment->execute($execution, $this->_api_context);
 
		$id               = $request->get('paymentId');
        $token            = $request->get('token');
        $payer_id         = $request->get('PayerID');
        $payment          = Payment::get($id, $this->_api_context);
        $paymentExecution = new PaymentExecution();
 
        $paymentExecution->setPayerId($payer_id);
        $result = $payment->execute($paymentExecution, $this->_api_context);
 


//----Validar pago

		if ($result->getState() == 'approved') { 
			$idTransaction = $this->saveOrder("Sin Revisar");

			$idTransactionDetail = $this->saveOrderDetail($idTransaction);			 
			$info = session('info');			
			$user = array(
				"idUser" => $info["user"],
				"message" => "Exito"				
			);
			\Session::forget('info');
			\Session::forget('cart');
			session()->put('user', $user);
			
			// return Redirect::route('registerComplete')
			// 	 ->with('message', 'Compra realizada de forma correcta');

			return redirect()->route('login')->with('message', 'Exito, compra realizada');
			// return Redirect()->route('payment');


		}
		
		
		$idTransaction = $this->saveOrder("Pago Pendiente");
		return \Redirect::route('registerComplete')
			->with('message', 'La compra fue cancelada');
	}
 
	protected function saveOrder($message)
	{
		// try{
			$info = session('info');	
			$transaction = transactionTable::find($info["idTransaction"]);
			$transaction->currency = "1200";
			$transaction->datetime = date('Y-m-d H:i:s');
			$transaction->status = $message;		
			$transaction->id_customer = $info["customer"];					
			$transaction->save();   			
			$idTransaction = $transaction->id;

			return $idTransaction;
		// }		
		// catch(\Exception $e){
		// 	return "";
		// }		
	}
 
	protected function saveOrderDetail($idTransaction)
	{
		// try{
			$info = session('info');		
			$transactionDetail = new transactiondetail;
			$transactionDetail->name = $info["name"];
			$transactionDetail->description = "Description";
			$transactionDetail->price = $info["price"];
			$transactionDetail->quantity = "1";					
			$transactionDetail->payment = "paypal";		
			$transactionDetail->id_transaction = $idTransaction;		
			$transactionDetail->save();   			
			$idTransactionDetail = $transactionDetail->id;

			return $idTransactionDetail;
		// }		
		// catch(\Exception $e){
		// 	return "";
		// }		
	}
}
