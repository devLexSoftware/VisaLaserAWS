<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use App\customer;
use App\userMe;
use App\userstatus;
// use App\transaction;
use App\transactionTable;
use App\transactiondetail;
use App\procedure;
use App\education;
use App\job;
use App\contact;
use App\parents;
use App\travel;
use App\Orders;
use App\spouse;
use App\background;
use App\HistoryJob;
use App\AdditionalInfo;
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
            
        // try{

                $check = $this->checkUser();
                if($check == null )
                {
                            
                    $idCustomer = $this->saveCustomer();
                    if($idCustomer != "error-14"){

                        $idUser = $this->saveUser($idCustomer);            
                        if($idUser != "error-00"){
                        

                            $idProcedure = $this->saveProcedure($idCustomer);
                            if($idProcedure == "error-01")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 01'])->withInput();
                            
                            $idEducation = $this->saveEducation($idProcedure);
                            if($idEducation == "error-02")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 02'])->withInput();

                            $idJob = $this->saveJob($idProcedure);
                            if($idJob == "error-04")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 04'])->withInput();

                            $idContact = $this->saveContact($idProcedure);
                            if($idContact == "error-05")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 05'])->withInput();

                            $idParent = $this->saveParent($idProcedure);
                            if($idParent == "error-06")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 06'])->withInput();

                            $idSpouse = $this->saveSpouse($idProcedure);            
                            if($idSpouse == "error-03")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 03'])->withInput();
                            
                            

                            ///---nuevas tablas 
                            $idBackground = $this->saveBackground($idCustomer);            
                            if($idBackground == "error-15")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 15'])->withInput();
                            $idAdditional = $this->saveAdditionalInfo($idCustomer);            
                            if($idAdditional == "error-16")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 16'])->withInput();
                            $idHistory = $this->saveHistory($idCustomer);            
                            if($idHistory == "error-17")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 17'])->withInput();    
                            $idTravel = $this->saveTravel($idProcedure);            
                            if($idTravel == "error-18")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 18'])->withInput();    

                            $idTransaction = $this->saveOrder("Pago Pendiente", $idCustomer);
                            if($idTransaction == "error-07")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 07'])->withInput();

                        

                            $info = array(
                                "user" => $idUser,
                                "customer" => $idCustomer,
                                "name" => request("in_nombre")." ".request("in_apellidos"),                    
                                "dir" => "",//request("in_address")." ".request("in_numExt")." ".request("in_numInt")." ".request("in_colonia")." ".request("in_state")." ".request("in_city"),
                                "price" => request("costoTotal"),
                                "idTransaction" => $idTransaction
                            );
                            session()->put('info', $info);


                            Auth::logout();
                            

                            //--Envio de correo
                            try{
                                $nameinemail = request("in_nombre")." ".request("in_apellidos");
                                $subject = "Registro en VisaLaser";
                                $for = request("in_email");
                                Mail::send('pages.email',[], function($msj) use($subject,$for){
                                    $msj->from("desarrollolexsoftwawre@gmail.com","Lexsoftware");
                                    $msj->subject($subject);
                                    $msj->to($for);
                                });
                            }
                            catch(\Exception $e){

                            }

                            //--MEtodo de pago
                            if(request("paymethod") == "tarjeta"){
                                $conektaPay = $this->conektaPay($idCustomer);
                                if($conektaPay != "true")                    
                                    return Redirect::back()->withErrors([$conektaPay])->withInput();                                    
                                
                                $Transaction = $this->updateOrder("Sin Revisar", $idCustomer, $idTransaction);
                                if($Transaction == "error-12")                    
                                    return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 12'])->withInput();

                                $idTransactionDetail = $this->updateOrderDetail($idTransaction);			 
                                if($idTransactionDetail == "error-13")                    
                                    return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 13'])->withInput();

                                
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
                            return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 00'])->withInput();
                            
                        }

                    }
                    else{
                        return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 14'])->withInput();
                    }  
                }

                //--Reintentar forma de pago
                else{                
                    $tran = $this->checkTransaction($check["id_customer"]);
                    if($tran["status"] == "Pago Pendiente")
                    {
                        if(request("paymethod") == "tarjeta"){

                            $conektaPay = $this->conektaPay($check["id_customer"]);
                            
                            if($conektaPay != "true")                    
                                return Redirect::back()->withErrors(["Se creo un usuario con su correo electronico, pero se detecto el siguiente error:".$conektaPay."Si el problema persiste intente pagar en otro momento, ya no es necesario volver a registarse. "])->withInput();
                                
    
                            
                            $Transaction = $this->updateOrder("Sin Revisar", $check["id_customer"], $tran["id"]);
                            if($Transaction == "error-12")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 12'])->withInput();
    
                            $idTransactionDetail = $this->updateOrderDetail($tran["id"]);			 
                            if($idTransactionDetail == "error-13")                    
                                return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 13'])->withInput();
    
                            
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
                        return redirect()->route('login')->with('message', 'Ya existe un usuario con el correo: '.request("in_email"));

                    }                    

                }
                
        // }    
        
        // catch(\Exception $e){
        //     //    return "";
    
        //         //  return Redirect::back();
        //         return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: General'])->withInput();
    
        //     }
    }

    protected function checkUser(){
        $user = userMe::where('email', request("in_email"))->first();
        return $user;

    }

    protected function checkTransaction($id_customer){
        $tran = transactionTable::where('id_customer', $id_customer)->first();
        return $tran;
    }    
    

    protected function saveCustomer(){

        //  try{
            $customer = new customer;
            $customer->firstName = request("in_nombre");
            $customer->lastName = request("in_apellidoPaterno");
            $customer->lastNameMother = request("in_apellidoMaterno");
            $customer->sex = request("in_sex");
            $customer->movil = request("in_movil");
            $customer->telephone = request("in_phone");
            $customer->workphone = "";
            $customer->birthday = request("in_birthday");
            $customer->address = "";//request("in_address")." ".request("in_numExt")." ".request("in_numInt")." ".request("in_colonia")." ".request("in_state")." ".request("in_city");
            $customer->street = "";//request("in_address");
            $customer->subur = request("in_colonia");
            $customer->numExt = request("in_numExt");
            $customer->numInt = request("in_numInt");
            $customer->cp = request("in_cp");
            $customer->city = request("in_city");
            $customer->state = request("in_state");            
            $customer->save();        
            $idCustomer = $customer->id;
            
            return $idCustomer;
        // }
        // catch(\Exception $e){
        //    return "";

            //  return Redirect::back();
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 01'])->withInput();
        //     return "error-14";


        // }
    }

    protected function saveUser($idCustomer){

        try{
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
        }
        catch(\Exception $e){
            // return "";
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 02']);
            return "error-00";

        }
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
        //     // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 03'])->withInput();
        //     return "error-01";
            
        // }
    }

    protected function saveBackground($idCustomer){

        // try{
            $background = new background;
            $background->id_customer = $idCustomer;            
            $background->save();        
            $idBackground = $background->id;
    
            return $idBackground;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 03'])->withInput();
        //     return "error-01";
            
        // }
    }

    protected function saveTravel($idProcedure){

        // try{
            $travel = new travel;
            $travel->id_procedure = $idProcedure;            
            $travel->save();        
            $idTravel = $travel->id;
    
            return $idTravel;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 03'])->withInput();
        //     return "error-01";
            
        // }
    }

    protected function saveHistory($idCustomer){

        // try{
            $history = new HistoryJob;
            $history->id_customer = $idCustomer;            
            $history->save();        
            $idHistory = $history->id;
    
            return $idHistory;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 03'])->withInput();
        //     return "error-01";
            
        // }
    }

    protected function saveAdditionalInfo($idCustomer){

        // try{
            $info = new AdditionalInfo;
            $info->id_customer = $idCustomer;            
            $info->save();        
            $idInfo = $info->id;
    
            return $idInfo;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 03'])->withInput();
        //     return "error-01";
            
        // }
    }

    protected function saveEducation($idProcedure){

        try{
            $education = new education;
            $education->id_procedure = $idProcedure;
            
            $education->save();        
            $idEducation = $education->id;
    
            return $idEducation;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        }
        catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 04'])->withInput();            
            return "error-02";
            
        }
    }

    protected function saveSpouse($idProcedure){

        try{
            $spouse = new spouse;
            $spouse->id_procedure = $idProcedure;
            
            $spouse->save();        
            $idSpouce = $spouse->id;
    
            return $idSpouce;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        }
        catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 05'])->withInput();
            return "error-03";
        }
    }

    protected function saveJob($idProcedure){

        try{
            $job = new job;
            $job->id_procedure = $idProcedure;
            
            $job->save();        
            $idJob = $job->id;
    
            return $idJob;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        }
        catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 06'])->withInput();
            return "error-04";
        }
    }

    

    protected function saveContact($idProcedure){

        try{
            $contact = new contact;
            $contact->id_procedure = $idProcedure;
            
            $contact->save();        
            $idContact = $contact->id;
    
            return $idContact;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        }
        catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 07'])->withInput();
            return "error-05";
        }
    }

    protected function saveParent($idProcedure){

        try{
            $parent = new parents;
            $parent->id_procedure = $idProcedure;
            
            $parent->save();        
            $idParent = $parent->id;
    
            return $idParent;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        }
        catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 08'])->withInput();
            return "error-06";
        }
    }

    protected function saveOrder($message, $idCustomer){
		try{
					
			$transaction = new transactionTable;
			$transaction->currency = "0";
			$transaction->datetime = date('Y-m-d H:i:s');
			$transaction->status = $message;		
			$transaction->id_customer = $idCustomer;					
			$transaction->save();   			
			$idTransaction = $transaction->id;

			return $idTransaction;
		}		
		catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 09'])->withInput();
			return "error-07";
		}		
    }    

    protected function conektaPay($idCustomer){

        try{
        \Conekta\Conekta::setApiKey("key_4oeXDmtrEBSAyhpEJKRN9w");        
        \Conekta\Conekta::setApiVersion("2.0.0");

        $info = session('info');


        
            $order = \Conekta\Order::create(
              [
                "line_items" => [
                  [
                    "name" => "Visa Laser",
                    "unit_price" => request("costoTotal"),
                    "quantity" => 1
                  ]
                ],                
                "currency" => "USD",
                "customer_info" => [
                  "name" => request("in_nombre")." ".request("in_apellidoPaterno")." ".request("in_apellidoMaterno"),
                  "email" => request("in_email"),
                  "phone" => request("in_movil")
                ],               
                // "metadata" => ["reference" => "12987324097", "more_info" => "lalalalala"],
                "charges" => [
                  [
                    "payment_method" => [
                    //   "monthly_installments" => 3, //optional
                      "type" => "card",
                      "token_id" => request("conektaTokenId")//"tok_test_visa_4242"
                    ] //payment_method - use customer's default - a card
                      //to charge a card, different from the default,
                      //you can indicate the card's source_id as shown in the Retry Card Section
                  ]
                ]
              ]
            );
            return "true";
          } 
          catch (\Conekta\ProcessingError $error){        
            // return Redirect::back()->withErrors(["Ocurrio un error en el método de pago".$error])->withInput();
            // return "error-conekta";
            // return "Ocurrio un error en el método de pago".$error;
            return "Ocurrió un error en el método de pago verifique los datos y/o que cuente con fondos suficientes";
            
            
          } catch (\Conekta\ParameterValidationError $error){
            // return Redirect::back()->withErrors(["Ocurrio un error en el método de pago".$error])->withInput();
            // return "error-conekta";
            // return "Ocurrio un error en el método de pago".$error;
            return "Ocurrió un error en el método de pago verifique los datos y/o que cuente con fondos suficientes";

            
          } catch (\Conekta\Handler $error){
            // return Redirect::back()->withErrors(["Ocurrio un error en el método de pago".$error])->withInput();            
            // return "error-conekta";
            // return "Ocurrio un error en el método de pago".$error;
            return "Ocurrió un error en el método de pago verifique los datos y/o que cuente con fondos suficientes";

          
          }


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
        try{
            $Order = new Orders;
			$Order->subtotal = $conektaid;
			$Order->shipping = $conektaCode;
			$Order->user_id = $idCustomer;					
			$Order->save();   			
            $idOrder = $Order->id;
            return $idOrder;
            
        }
        catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 10'])->withInput();
            return "error-08";
        }
		
    }

    protected function saveOrderAfter($message, $idCustomer, $Transaction){
		try{
			$info = session('info');	
			$transaction = $Transaction;
			$transaction->currency = "1200";
			$transaction->datetime = date('Y-m-d H:i:s');
			$transaction->status = $message;		
			$transaction->id_customer = $idCustomer;	
			$transaction->save();   			
			$idTransaction = $transaction->id;

			return $idTransaction;
		}		
		catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 11'])->withInput();
			return "error-09";
		}		
    }
    
    protected function saveOrderDetail($idTransaction){
		try{
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
		}		
		catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 11'])->withInput();
            return "error-10";
		}		
    }
    
    protected function repeatPaymethod(){
         //--MEtodo de pago
         try{


            $info = array(
                "user" => request("basic_usId"),
                "customer" => request("basic_cuId"),
                "idTransaction" => request("basic_trId"),
                "price" => request("costoTotal"),
                "name" => request("in_nombre")." ".request("in_apellidoPaterno")." ".request("in_apellidoMaterno"),                    

            );  
            
            if(request("paymethod") == "tarjeta"){
                
                
                $conektaPay = $this->conektaPay(request("basic_cuId"));
                if($conektaPay != "true")                    
                   return Redirect::back()->withErrors([$conektaPay])->withInput();
             
                
                $Transaction = $this->updateOrder("Sin Revisar", request("basic_cuId"), request("basic_trId"));
                if($Transaction == "error-12")                    
                    return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 12'])->withInput();

                $idTransactionDetail = $this->updateOrderDetail(request("basic_trId"));			                                             
                if($idTransactionDetail == "error-13")                    
                    return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 13'])->withInput();


                return redirect()->route('login')->with('message', 'Exito, compra realizada');
                
            }
            else{
                
                
                session()->put('info', $info);
                

                return Redirect()->route('payment');
            }
        }
        catch(\Exception $e){
            // return Redirect::back()->withErrors([ 'Ocurrio un error al guardar, intente de nuevo. Si tiene problemas contactenos. Code error: 12'])->withInput();
            return "error-11";
		}	

    }

    protected function updateOrder($message, $idCustomer, $idTransaction){
		try{
                    
            $transaction = transactionTable::find($idTransaction);
            			
			$transaction->currency = "0";
			$transaction->datetime = date('Y-m-d H:i:s');
			$transaction->status = $message;		
			$transaction->id_customer = $idCustomer;					
			$transaction->save();   						

			return $idTransaction;
		}		
		catch(\Exception $e){
            return "error-12";
			
		}		
    }  

    protected function updateOrderDetail($idTransaction){
		try{			
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
		}		
		catch(\Exception $e){
            return "error-13";
			
		}		
    }
    


}



