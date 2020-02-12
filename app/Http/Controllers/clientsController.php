<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\customer;
use App\userMe;
use App\userstatus;
use App\transactionTable;
use App\procedure;
use App\education;
use App\job;
use App\contact;
use App\parents;
use App\spouse;
use Auth;
use DB;


class clientsController extends Controller
{
    //


   

    public function dashboard(){
        if(Auth::guard('admin')->check()){
            $data = DB::table('transaction')
            ->select('transaction.currency as trCurrency', 'transaction.id as trId', 'transaction.status as trStatus' )           
           ->get();
           
           return view('pages.pageDash', ['customer' => $data]);  
         }
         else{
            return Redirect::to('/');                
         }
    }

    public function clientesPendientes(){        

         if(Auth::guard('admin')->check()){
            $data = DB::table('customer')
            ->select('customer.id as curId' , 'customer.firstName as cuFirst', 'customer.lastName as cuLast', 'customer.sex as cuSex', 'customer.telephone as cuTelephone', 'customer.birthday as cuBirthday',  'customer.address as cuAddress', 
            'user.id as usId','user.email as usEmail', 
            'transaction.id as trId', 'transaction.currency as trCurrency', 'transaction.dateTime as trDateTime', 'transaction.status as trStatus')
           ->join('user', 'user.id_customer', '=', 'customer.id')  
           ->join('transaction', 'transaction.id_customer', '=', 'customer.id')        
           ->where('transaction.status', '=', 'Pago Pendiente')->get();
           return view('pages.dashClientesPendientes', ['customer' => $data]);  
         }
         else{
            return Redirect::to('/');                
         }

        
    }

    public function clientesSinRevisar(){        

      if(Auth::guard('admin')->check()){
         
        $data = DB::table('customer')
        ->select('customer.id as curId' , 'customer.firstName as cuFirst', 'customer.lastName as cuLast', 'customer.sex as cuSex', 'customer.telephone as cuTelephone', 'customer.birthday as cuBirthday',  'customer.address as cuAddress', 
        'user.id as usId','user.email as usEmail', 
        'transaction.id as trId', 'transaction.currency as trCurrency', 'transaction.dateTime as trDateTime', 'transaction.status as trStatus')
       ->join('user', 'user.id_customer', '=', 'customer.id')  
       ->join('transaction', 'transaction.id_customer', '=', 'customer.id')    
       ->where('transaction.status', '=', 'Sin Revisar')->get();
       return view('pages.dashClientesReservar', ['customer' => $data]);
      }
      else{
         return Redirect::to('/');  
      }
    }

    public function clientesRevisadas(){      
       
      if(Auth::guard('admin')->check()){

        $data = DB::table('customer')
        ->select('customer.id as curId' , 'customer.firstName as cuFirst', 'customer.lastName as cuLast', 'customer.sex as cuSex', 'customer.telephone as cuTelephone', 'customer.birthday as cuBirthday',  'customer.address as cuAddress', 
        'user.id as usId','user.email as usEmail', 
        'transaction.id as trId', 'transaction.currency as trCurrency', 'transaction.dateTime as trDateTime', 'transaction.status as trStatus')
       ->join('user', 'user.id_customer', '=', 'customer.id')  
       ->join('transaction', 'transaction.id_customer', '=', 'customer.id')    
       ->where('transaction.status', '=', 'Revisado')->get();
            return view('pages.dashClientesRevisadas', ['customer' => $data]);
      }
      else{
         return Redirect::to('/');  
      }
    }

    public function clientesTodos(){        

      if(Auth::guard('admin')->check()){

        $data = DB::table('customer')
        ->select('customer.id as curId' , 'customer.firstName as cuFirst', 'customer.lastName as cuLast', 'customer.sex as cuSex', 'customer.telephone as cuTelephone', 'customer.birthday as cuBirthday',  'customer.address as cuAddress', 
        'user.id as usId','user.email as usEmail', 
        'transaction.id as trId', 'transaction.currency as trCurrency', 'transaction.dateTime as trDateTime', 'transaction.status as trStatus')
       ->join('user', 'user.id_customer', '=', 'customer.id')  
       ->join('transaction', 'transaction.id_customer', '=', 'customer.id')
       ->get();       
       return view('pages.dashClientesTodos', ['customer' => $data]);
      }
      else{
         return Redirect::to('/');  
      }
    }

    public function clienteEdicion($id){      
       
      if(Auth::guard('admin')->check()){
      
        $data = DB::table('customer')
        ->select('customer.id as curId' , 'customer.firstName as cuFirst', 'customer.lastName as cuLast', 'customer.sex as cuSex', 'customer.telephone as cuTelephone', 'customer.birthday as cuBirthday',  'customer.address as cuAddress', 
        'user.id as usId','user.email as usEmail', 'procedure.civilStatus as prCivil', 'procedure.visaType as prVisa',
        'education.id as edId', 'education.school as edSchool', 'education.city as edCity', 'education.admissionDate as edAdmission', 'education.egressDate as edEgress', 'education.level as edLEvel',
        'job.id as joId', 'job.company as joCompany', 'job.address as joAddress', 'job.ocupation as joOcupation', 'job.activities as joActivities', 'job.salary as joSalary', 'job.carrer as joCarrer', 'job.description as joDescription', 
        'spouse.id as spId', 'spouse.name as spName', 'spouse.birthday as spBirthday', 'spouse.birthplace as spBirthdayPlace', 'spouse.living as spLiving', 'spouse.divorciedDate as spDivorcied', 'spouse.marryDate as spMarryDate', 'spouse.description as spDescription', 
        'contact.id as coId', 'contact.name as coName', 'contact.relationship as coRelationship', 'contact.telephone as coTelephone', 'contact.city as coCity',
        'parent.id as paId', 'parent.nameMother as paNameMother', 'parent.statusMigratoryMother as paStatusMigratoryMother', 'parent.nameFather as paNameFather', 'parent.statusMigratoryFather as paStatusMigratoryFather', 'parent.birthdayMother as paBirthdayMother', 'parent.birthdayFather as paBirthdayFather',
        'transaction.id as trId', 'transaction.currency as trCurrency', 'transaction.dateTime as trdate', 'transaction.status as trStatus')
        ->join('user', 'user.id_customer', '=', 'customer.id')  
        ->join('procedure', 'procedure.id_customer', '=', 'customer.id')
        ->join('education', 'education.id_procedure', '=', 'procedure.id')
        ->join('contact', 'contact.id_procedure', '=', 'procedure.id')
        ->join('parent', 'parent.id_procedure', '=', 'procedure.id')
        ->join('job', 'job.id_procedure', '=', 'procedure.id')
        ->join('spouse', 'spouse.id_procedure', '=', 'procedure.id')
        ->join('transaction', 'transaction.id_customer', '=', 'customer.id')
        ->where('user.id', '=', $id)->get();       
        return view('pages.dashClientesEdicion', ['customer' => $data]);

      }
      else{
         return Redirect::to('/');  
      }
    }   


    public function saveClientInformation($opcion)
    {
 
        if($opcion == 1){
            $this->saveClientStatus();
            $idUser = request("basic_usId2");
        }
        else{
            $idCustomer = $this->saveCustomer();
            $idUser = $this->saveUser();        
            $idSpouse = $this->saveSpouse();
            $idParent = $this->saveParent();
            $idContact = $this->saveContact();
            $idEducation = $this->saveEducation();
            $idJob = $this->saveJob();

            $idUser = request("basic_usId1");
        }
        
      
        return redirect()->route('clientesEdicion', $idUser)->with('success','Registro actualizado satisfactoriamente');
    }

    public function saveClientStatus(){
        
        //  try{            
            $transaction = transactionTable::find(request("transaction_Id"));

            $transaction->status = "Revisado";
            
            $transaction->save();                    
            $idTransaction = $transaction->id;
            return $idTransaction;
                        
        // }
        // catch(\Exception $e){
        //    return "";

        //     //  return Redirect::back();
        // }
    }

    protected function saveCustomer(){

        //  try{            
            $customer = customer::find(request("basic_cuId"));

            $customer->firstName = request("basic_nombre");
            $customer->lastName = request("basic_apellidos");
            $customer->sex = request("basic_sex");
            $customer->telephone = request("basic_phone");
            $customer->birthday = request("basic_birthday");
            $customer->address = request("basic_address");//." ".request("in_colonia").", ".request("in_numExt").", ".request("in_numInt").", ".request("in_state").", ".request("in_city");
            $customer->save();        
            $idCustomer = $customer->id;
            
            return $idCustomer;
        // }
        // catch(\Exception $e){
        //    return "";

        //     //  return Redirect::back();
        // }
    }

    protected function saveUser(){

        // try{
            
            $user = userMe::find(request("basic_usId"));            
            $user->code = request("basic_email");            
            $user->email = request("basic_email");            
            if(request("basic_password1") != ""){
                $user->password = md5(request("basic_password1"));            
            }
            
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

    protected function saveSpouse(){

        // try{
            $spouse = spouse::find(request("married_spId"));
            
            $spouse->name = request("married_nombre");
            $spouse->birthday = request("married_birthday");
            $spouse->birthplace = request("married_place");
            $spouse->living = request("married_living");
            $spouse->divorciedDate = request("married_dateDivorced");
            $spouse->marryDate = request("married_dateMarriend");            
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

    protected function saveParent(){

        // try{
            $parent = parents::find(request("parent_paId"));

            $parent->nameMother = request("parent_nameMother");
            $parent->statusMigratoryMother = request("parent_motherStatus");
            $parent->birthdayMother = request("parent_motherBirthday");
            $parent->nameFather = request("parent_nameFather");
            $parent->statusMigratoryFather = request("parent_fatherStatus");
            $parent->birthdayFather = request("parent_fatherBirthday");
            
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

    protected function saveContact(){

        // try{
            $contact = contact::find(request("contact_coId"));

            $contact->name = request("contact_nombre");
            $contact->relationship = request("contact_relation");
            $contact->telephone = request("contact_phone");
            $contact->city = request("contact_living");
            
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

    protected function saveEducation(){

        // try{
            $education = education::find(request("education_edId"));

            $education->school = request("education_name");
            $education->city = request("education_city");
            $education->admissionDate = request("education_ingress");
            $education->egressDate = request("education_egress");
            $education->egressDate = request("education_egress");
            $education->level = request("education_grade");
            
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

    protected function saveJob(){

        // try{
            $job = job::find(request("job_id"));

            $job->company = request("job_name");
            $job->address = request("job_direction");
            $job->activities = request("job_activities");
            $job->ocupation = request("job_ocupation");
            $job->salary = request("job_salary");
            $job->carrer = request("job_carrer");
            
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




    
}
