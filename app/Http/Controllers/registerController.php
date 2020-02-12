<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

 
use App\customer;
use App\userMe;
use App\userstatus;
use App\transaction;
use App\procedure;
use App\education;
use App\job;
use App\contact;
use App\parents;
use App\spouse;
use Auth;


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

        
        //Insert in customer
        $idCustomer = $this->saveCustomer();
        if($idCustomer != ""){

            $idUser = $this->saveUser($idCustomer);            
            if($idUser != ""){
                $info = array(
                    "user" => $idUser,
                    "customer" => $idCustomer,
                    "name" => request("in_nombre")." ".request("in_apellidos"),
                    "dir" => request("in_address"),
                    "price" => "1200"
                );
                session()->put('info', $info);

                $idProcedure = $this->saveProcedure($idCustomer);
                $idEducation = $this->saveEducation($idProcedure);
                $idJob = $this->saveJob($idProcedure);
                $idContact = $this->saveContact($idProcedure);
                $idParent = $this->saveParent($idProcedure);
                $idSpouse = $this->saveSpouse($idProcedure);

                Auth::logout();
                


                return Redirect()->route('payment');
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

}


