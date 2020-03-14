<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use App\customer;
use App\userMe;
use App\userstatus;
use App\transaction;
use App\transactionTable;
use App\transactiondetail;
use App\procedure;
use App\education;
use App\job;
use App\contact;
use App\parents;
use App\Orders;
use App\spouse;
use Auth;

use Conekta\Conekta;
use Conekta\Order;
use Conekta\Charge;

use Mail;



class registerController extends Controller
{
    //
    public function status(){
        $valor1 = request("pregunta_1");
        $valor2 = request("pregunta_2");
        $valor3 = request("pregunta_3");
        $valor4 = request("pregunta_4");
        $valor5 = request("pregunta_5");
        $valor6 = request("pregunta_6");

        if($valor1 == "Si" && $valor3 != "3" && $valor4 == "Si" && $valor5 == "No" && $valor6 == "No" && ($valor2 != "Estudio" && $valor2 != "Trabajar")){
            return View('pages.statusRegister');
        }
        return View('pages.home');
        // return View('pages.statusRegister');
    }    

    public function registerPaymethod(){
                

        
        
        
        // //Insert in customer
        $idCustomer = $this->saveCustomer();
        if($idCustomer != ""){

            $idUser = $this->saveUser($idCustomer);            
            if($idUser != ""){
               

                $idProcedure = $this->saveProcedure($idCustomer);
                $idEducation = $this->saveEducation($idProcedure);
                $idJob = $this->saveJob($idProcedure);
                $idContact = $this->saveContact($idProcedure);
                $idParent = $this->saveParent($idProcedure);
                $idSpouse = $this->saveSpouse($idProcedure);            
                $idTransaction = $this->saveOrder("Pago Pendiente", $idCustomer);

                $info = array(
                    "user" => $idUser,
                    "customer" => $idCustomer,
                    "name" => request("in_nombre")." ".request("in_apellidos"),                    
                    "dir" => request("in_address"),
                    "price" => "1200",
                    "idTransaction" => $idTransaction
                );
                session()->put('info', $info);


                Auth::logout();
                

                //--Envio de correo
                $subject = "Registro en VisaLaser";
                $for = "eliotdagon@gmail.com";//request("in_email");
                Mail::send('pages.email',[], function($msj) use($subject,$for){
                    $msj->from("desarrollolexsoftwawre@gmail.com","Lexsoftware");
                    $msj->subject($subject);
                    $msj->to($for);
                });


                //--MEtodo de pago
                if(request("paymethod") == "tarjeta"){
                    $conektaPay = $this->conektaPay($idCustomer);
                    
                    $Transaction = $this->saveOrder("Sin Revisar", $idCustomer, $idTransaction);
                    $idTransactionDetail = $this->saveOrderDetail($idTransaction);			 
                    
                    $info = session('info');			
                    $user = array(
                        "idUser" => $info["user"],
                        "message" => "Exito"				
                    );

			        return redirect()->route('login')->with('message', 'Exito, compra realizada');
                    
                }
                else{
                    return Redirect()->route('payment');
                }


            }      
            else{
                return Redirect::back()->withErrors(['Error el correo ya existe, inicie sessión.']);    
            }

        }
        else{
            return Redirect::back()->withErrors(['Error el correo ya existe, inicie sessión.']);
        }                        
    }

    protected function saveCustomer(){

        //  try{
            $customer = new customer;
            $customer->firstName = request("in_nombre");
            $customer->lastName = request("in_apellidos");
            $customer->sex = "";
            $customer->telephone = "";
            $customer->birthday = "";
            $customer->address = request("in_address")." ".request("in_numExt")." ".request("in_numInt")." ".request("in_colonia")." ".request("in_state")." ".request("in_city");
            $customer->save();        
            $idCustomer = $customer->id;
            
            return $idCustomer;
        // }
        // catch(\Exception $e){
        //    return "";

        //     //  return Redirect::back();
        // }
    }

    protected function saveUser($idCustomer){

        // try{
            $user = new userMe;
            $user->code = request("in_email");
            $user->email = request("in_email");
            $user->password = md5(request("in_password1"));
            $user->token = "";
            $user->id_userstatus = 1;
            $user->id_usertype = 1;
            $user->id_customer = $idCustomer;
            $user->save();        
            $idUser = $user->id;
    
            return $idUser;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveProcedure($idCustomer){

        // try{
            $procedure = new procedure;
            $procedure->id_customer = $idCustomer;
            $procedure->id_procedurestatus = 1;             
            $procedure->save();        
            $idProcedure = $procedure->id;
    
            return $idProcedure;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveEducation($idProcedure){

        // try{
            $education = new education;
            $education->id_procedure = $idProcedure;
            
            $education->save();        
            $idEducation = $education->id;
    
            return $idEducation;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveSpouse($idProcedure){

        // try{
            $spouse = new spouse;
            $spouse->id_procedure = $idProcedure;
            
            $spouse->save();        
            $idSpouce = $spouse->id;
    
            return $idSpouce;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveJob($idProcedure){

        // try{
            $job = new job;
            $job->id_procedure = $idProcedure;
            
            $job->save();        
            $idJob = $job->id;
    
            return $idJob;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveContact($idProcedure){

        // try{
            $contact = new contact;
            $contact->id_procedure = $idProcedure;
            
            $contact->save();        
            $idContact = $contact->id;
    
            return $idContact;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveParent($idProcedure){

        // try{
            $parent = new parents;
            $parent->id_procedure = $idProcedure;
            
            $parent->save();        
            $idParent = $parent->id;
    
            return $idParent;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveOrder($message, $idCustomer){
		// try{
					
			$transaction = new transactionTable;
			$transaction->currency = "0";
			$transaction->datetime = date('Y-m-d H:i:s');
			$transaction->status = $message;		
			$transaction->id_customer = $idCustomer;					
			$transaction->save();   			
			$idTransaction = $transaction->id;

			return $idTransaction;
		// }		
		// catch(\Exception $e){
		// 	return "";
		// }		
    }    

    protected function conektaPay($idCustomer){
        \Conekta\Conekta::setApiKey("key_4oeXDmtrEBSAyhpEJKRN9w");        
        \Conekta\Conekta::setApiVersion("2.0.0");

        $info = session('info');


        // try{
            $order = \Conekta\Order::create(
              [
                "line_items" => [
                  [
                    "name" => "Visa Laser",
                    "unit_price" => 2000,
                    "quantity" => 1
                  ]
                ],                
                "currency" => "MXN",
                "customer_info" => [
                  "name" => request("in_nombre")." ".request("in_apellidos"),
                  "email" => request("in_email"),
                  "phone" => "+524622645629"
                ],               
                "metadata" => ["reference" => "12987324097", "more_info" => "lalalalala"],
                "charges" => [
                  [
                    "payment_method" => [
                    //   "monthly_installments" => 3, //optional
                      "type" => "card",
                      "token_id" => "tok_test_visa_4242"
                    ] //payment_method - use customer's default - a card
                      //to charge a card, different from the default,
                      //you can indicate the card's source_id as shown in the Retry Card Section
                  ]
                ]
              ]
            );
        //   } 
        //   catch (\Conekta\ProcessingError $error){
        //     echo $error->getMessage();
        //   } catch (\Conekta\ParameterValidationError $error){
        //     echo $error->getMessage();
        //   } catch (\Conekta\Handler $error){
        //     echo $error->getMessage();
        //   }


        $idOrders = $this->saveOrders($order->id, $order->charges[0]->payment_method->auth_code, $idCustomer);



        //   echo "ID: ". $order->id;
        // echo "Status: ". $order->payment_status;
        // echo "$". $order->amount/100 . $order->currency;
        // echo "Order";
        // echo $order->line_items[0]->quantity .
        //     "-". $order->line_items[0]->name .
        //     "- $". $order->line_items[0]->unit_price/100;
        // echo "Payment info";
        // echo "CODE:". $order->charges[0]->payment_method->auth_code;
        // echo "Card info:".
        //     "- ". $order->charges[0]->payment_method->name .
        //     "- ". $order->charges[0]->payment_method->last4 .
        //     "- ". $order->charges[0]->payment_method->brand .
        //     "- ". $order->charges[0]->payment_method->type;


    }

    protected function saveOrders($conektaid, $conektaCode, $idCustomer){
            $Order = new Orders;
			$Order->subtotal = $conektaid;
			$Order->shipping = $conektaCode;
			$Order->user_id = "70";//$idCustomer;					
			$Order->save();   			
            $idOrder = $Order->id;
            return $idOrder;
    }

    protected function saveOrderAfter($message, $idCustomer, $Transaction){
		// try{
			$info = session('info');	
			$transaction = $Transaction;
			$transaction->currency = "1200";
			$transaction->datetime = date('Y-m-d H:i:s');
			$transaction->status = $message;		
			$transaction->id_customer = $idCustomer;	
			$transaction->save();   			
			$idTransaction = $transaction->id;

			return $idTransaction;
		// }		
		// catch(\Exception $e){
		// 	return "";
		// }		
    }
    
    protected function saveOrderDetail($idTransaction){
		// try{
			$info = session('info');		
			$transactionDetail = new transactiondetail;
			$transactionDetail->name = $info["name"];
			$transactionDetail->description = "Description";
			$transactionDetail->price = $info["price"];
			$transactionDetail->quantity = "1";					
			$transactionDetail->payment = "conekta";		
			$transactionDetail->id_transaction = $idTransaction;		
			$transactionDetail->save();   			
			$idTransactionDetail = $transactionDetail->id;

			return $idTransactionDetail;
		// }		
		// catch(\Exception $e){
		// 	return "";
		// }		
    }
    
    protected function repeatPaymethod(){
         //--MEtodo de pago

         


         if(request("paymethod") == "tarjeta"){
            
            
            $conektaPay = $this->conektaPay(request("basic_cuId"));
            
            $Transaction = $this->updateOrder("Sin Revisar", request("basic_cuId"), request("basic_trId"));
            $idTransactionDetail = $this->updateOrderDetail(request("basic_trId"));			                                             
            return redirect()->route('login')->with('message', 'Exito, compra realizada');
            
        }
        else{
            
            $info = array(
                "user" => request("basic_usId"),
                "customer" => request("basic_cuId"),
                "idTransaction" => request("basic_trId")
            );

            return Redirect()->route('payment');
        }
    }

    protected function updateOrder($message, $idCustomer, $idTransaction){
		// try{
                    
            $transaction = transaction::find($idTransaction);
            			
			$transaction->currency = "0";
			$transaction->datetime = date('Y-m-d H:i:s');
			$transaction->status = $message;		
			$transaction->id_customer = $idCustomer;					
			$transaction->save();   						

			return $idTransaction;
		// }		
		// catch(\Exception $e){
		// 	return "";
		// }		
    }  

    protected function updateOrderDetail($idTransaction){
		// try{			
			$transactionDetail = new transactiondetail;
			$transactionDetail->name = "";
			$transactionDetail->description = "Description";
			$transactionDetail->price = "";
			$transactionDetail->quantity = "1";					
			$transactionDetail->payment = "conekta";		
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


