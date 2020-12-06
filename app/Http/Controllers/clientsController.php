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

use App\travel;

use App\HistoryJob;
use App\background;
use App\AdditionalInfo;

use Auth;
use DB;

use Mail;


class clientsController extends Controller
{
    //


    public function dashboardPago(){
        if(Auth::guard('admin')->check()){

            $currencyExito = DB::table('transaction')            
            ->where('transaction.status', '=', 'Exito')
            ->sum('transaction.currency');

            $clientesExito = DB::table('transaction')            
            ->where('transaction.status', '=', 'Exito')
            ->count('transaction.status');

            $clientesPendiente = DB::table('transaction')            
            ->where('transaction.status', '=', 'Pago Pendiente')
            ->count('transaction.status');

            $clientesSinRevisar = DB::table('transaction')            
            ->where('transaction.status', '=', 'Sin Revisar')
            ->count('transaction.status');

            $clientesRevisado = DB::table('transaction')            
            ->where('transaction.status', '=', 'Revisado')
            ->count('transaction.status');

            $clientesTodos = DB::table('transaction')                        
            ->count('transaction.status');



            $sinRevisar = DB::table('customer')
                ->select('customer.id as curId' , 'customer.firstName as cuFirst', 'customer.lastName as cuLast', 'customer.sex as cuSex', 'customer.telephone as cuTelephone', 'customer.birthday as cuBirthday',  'customer.address as cuAddress', 
                'user.id as usId','user.email as usEmail', 
                'transaction.id as trId', 'transaction.currency as trCurrency', 'transaction.dateTime as trDateTime', 'transaction.status as trStatus')
                ->join('user', 'user.id_customer', '=', 'customer.id')  
                ->join('transaction', 'transaction.id_customer', '=', 'customer.id')    
                ->where('transaction.status', '=', 'Sin Revisar')->get();

            $data = [$currencyExito, $clientesExito, $clientesPendiente, $clientesSinRevisar, $clientesRevisado, $clientesTodos];
           
           return view('pages.dashWidget',['data' => $data, 'customer' => $sinRevisar]);  
         }
         else{
            return Redirect::to('/');                
         }

    }
   

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
        ->select('customer.id as curId' , 'customer.firstName as cuFirst', 'customer.lastName as cuLast', 'customer.lastNameMother as cuLastMother', 'customer.sex as cuSex', 'customer.telephone as cuTelephone', 'customer.birthday as cuBirthday',  'customer.address as cuAddress', 
        'customer.street as cuStreet', 'customer.numExt as cunumExt', 'customer.numInt as cunumInt', 'customer.subur as cuSubur', 'customer.city as cuCity', 'customer.cp as cuCP', 'customer.workphone as cuWorkPhone',
        'customer.state as cuState', 'customer.movil as cuMovil',
        'user.id as usId','user.email as usEmail',
        'transaction.id as trId', 'transaction.status as trStatus',
        'education.id as edId', 'education.school as edSchool', 'education.city as edCity', 'education.admissionDate as edAdmission', 'education.egressDate as edEgress', 'education.level as edLevel',
        'job.id as joId', 'job.company as joCompany', 'job.address as joAddress', 'job.ocupation as joOcupation', 'job.activities as joActivities', 'job.salary as joSalary', 'job.carrer as joCarrer', 'job.description as joDescription', 'job.dateInit as jobDateInit',
        'spouse.id as spId', 'spouse.name as spName', 'spouse.birthday as spBirthday', 'spouse.birthplace as spBirthdayPlace', 'spouse.living as spLiving', 'spouse.divorciedDate as spDivorcied', 'spouse.marryDate as spMarryDate', 'spouse.description as spDescription', 
        'spouse.adress as spAdress', 
        'contact.id as coId', 'contact.name as coName', 'contact.relationship as coRelationship', 'contact.telephone as coTelephone', 'contact.city as coCity', 'contact.statusMigratory as coStatus',
        'contact.name2 as coName2', 'contact.relationship2 as coRelationship2', 'contact.telephone2 as coTelephone2', 'contact.city2 as coCity2', 'contact.statusMigratory2 as coStatus2',
        'parent.id as paId', 'parent.nameMother as paNameMother', 'parent.liveUSAMother as paLiveMother', 'parent.statusMigratoryMother as paStatusMigratoryMother', 'parent.nameFather as paNameFather', 'parent.liveUSAFather as paLiveFather', 'parent.statusMigratoryFather as paStatusMigratoryFather', 'parent.birthdayMother as paBirthdayMother', 'parent.birthdayFather as paBirthdayFather',
        'procedure.id as prId', 'procedure.birthplace as prBirthday', 'procedure.civilStatus as prCivil', 'procedure.homephone as prHo', 'procedure.address as prAddress', 'procedure.visaType as prVisaType', 'procedure.passport as prPassport',
        'procedure.passportCity as prPassportCity', 'procedure.passportExpedition as prPassportExpedition', 'procedure.passportExpiration as prPassportExpiration', 'procedure.solicitante as prSolicitante', 'procedure.visaDelivery as prvisaDelivery',
        'procedure.visaNeg as prvisaNeg', 'procedure.visaLostDate as prvVisaLostDate', 'procedure.visaLostDes as prvVisaLostDesc', 'procedure.deportee as prvDeporteeDesc', 'procedure.deporteeDate as prvDeporteeDate', 'procedure.ocupation as proOcupation',
        'procedure.prvVisaLostQues as prvVisaLostQues', 'procedure.prvDeporteeQues as prvDeporteeQues',
        'travel.purpose as traPurpose', 'travel.planning as traPlanning', 'travel.numReservation as traNumReservation', 'travel.dateReservation as traDateReservation', 'travel.date as traDate', 'travel.adressContact as traAdressContact',  'travel.nameContact as traNameContact',  
        'travel.relationContact as traRelationContact',  'travel.phoneContact as traPhoneContact', 'travel.situationContact as traSituationContact', 
        'travel.payName as traPayName', 'travel.payAdress as traPayAdress', 'travel.payRelation as traPayRelation', 'travel.payPhone as traPayPhone',
        'travel.visitCities as traVisitCities', 'travel.companionName as traCompanionName', 'travel.companionRelation as traCompanionRelation', 'travel.id as traId',
        'travel.traFriendQues as traFriendQues', 'travel.traPaymeQues as traPaymeQues', 'travel.traVisitContactQues as traVisitContactQues', 'travel.arreglo as traArreglo',
        'background.id as bacId', 'background.legal as bacLegal', 'background.timeAprox1 as bacTimeAprox1', 'background.date1 as bacDateAprox1',  'background.timeAprox2 as bacTimeAprox2', 'background.date2 as bacDateAprox2',  
        'background.timeAprox3 as bacTimeAprox3', 'background.date3 as bacDateAprox3',  'background.timeAprox4 as bacTimeAprox4', 'background.date4 as bacDateAprox4', 'HistoryJob.id as hijoId', 'background.bacVisitEU as bacVisitEU',
        'HistoryJob.history as hijoHistory', 'HistoryJob.companyName as hijoName', 'HistoryJob.companyPhone as hijoPhone', 'HistoryJob.bossName as hijoBoss', 'HistoryJob.dateStart as hijoDate', 'HistoryJob.note as hijoNote', 'HistoryJob.companyAdress as hijoDireccion',
        'AdditionalInfo.visitCountry as infCountries', 'AdditionalInfo.weapons as infWeapons', 'AdditionalInfo.weaponsInfo as infWeaponsInfo', 'AdditionalInfo.languages as infIdiomas', 'AdditionalInfo.arrested as infArrested', 
        'AdditionalInfo.facebook as infFacebook', 'AdditionalInfo.flickr as infFlickr', 'AdditionalInfo.instagram as infInstagram', 'AdditionalInfo.linkedin as infLinkedin', 'AdditionalInfo.myspace as infMySpace', 'AdditionalInfo.tumblr as infTumblr',
        'AdditionalInfo.twitter as infTwitter', 'AdditionalInfo.vine as infVine', 'AdditionalInfo.youtube as infYoutube', 'AdditionalInfo.pinterest as infPinterest', 'AdditionalInfo.reddit as infReddit', 'AdditionalInfo.id as infId', 
        'transaction.id as trId', 'transaction.currency as trCurrency', 'transaction.dateTime as trdate', 'transaction.status as trStatus')
        ->join('user', 'user.id_customer', '=', 'customer.id')  
           ->join('transaction', 'transaction.id_customer', '=', 'customer.id')  
           ->join('procedure', 'procedure.id_customer', '=', 'customer.id')
           ->join('HistoryJob', 'HistoryJob.id_customer', '=', 'customer.id')
           ->join('background', 'background.id_customer', '=', 'customer.id')
           ->join('AdditionalInfo', 'AdditionalInfo.id_customer', '=', 'customer.id')
           ->join('travel', 'travel.id_procedure', '=', 'procedure.id')
           ->join('education', 'education.id_procedure', '=', 'procedure.id')
           ->join('contact', 'contact.id_procedure', '=', 'procedure.id')
           ->join('parent', 'parent.id_procedure', '=', 'procedure.id')
           ->join('job', 'job.id_procedure', '=', 'procedure.id')
           ->join('spouse', 'spouse.id_procedure', '=', 'procedure.id')                  
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
            $idUser = request("basic_usId");
        }
        else{
            $idCustomer = $this->saveCustomer();
            $idUser = $this->saveUser();        

            $idSpouse = $this->saveSpouse();
            $idParent = $this->saveParent();
            $idContact = $this->saveContact();

            $idProcedure = $this->saveProcedure();
            $idJob = $this->saveJob();
            $idHistoryJob = $this->saveHistoryJob();
            $idEducation = $this->saveEducation();

            $idProcedure = $this->saveProcedure2();        
            $idTravel = $this->saveTravel();        
            $idBackground = $this->saveBackground();     
            $idAdditional = $this->saveAdditional2();                


            $idUser = request("basic_usId");
        }
        
        


            // return redirect()->back();
        

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
            $customer->lastName = request("basic_apellidoPaterno");
            $customer->lastNameMother = request("basic_apellidoMaterno");
            $customer->sex = request("basic_sex");
            $customer->telephone = request("basic_phone");
            $customer->movil = request("basic_movil");
            $customer->workphone = request("basic_workphone");
            $customer->birthday = request("basic_birthday");
            // $customer->address = request("basic_address");//." ".request("in_colonia").", ".request("in_numExt").", ".request("in_numInt").", ".request("in_state").", ".request("in_city");
            $customer->street = request("basic_street");
            $customer->subur = request("basic_colonia");
            $customer->numExt = request("basic_numExt");
            $customer->numInt = request("basic_numInt");
            $customer->cp = request("basic_cp");
            $customer->city = request("basic_city");
            $customer->state = request("basic_state");    
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
            $spouse->adress = request("married_adress");            
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
            $parent->liveUSAMother = request("parent_paLiveMother");
            $parent->nameFather = request("parent_nameFather");
            $parent->statusMigratoryFather = request("parent_fatherStatus");
            $parent->birthdayFather = request("parent_fatherBirthday");
            $parent->liveUSAFather = request("parent_paLiveFather");
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
            $contact->statusMigratory = request("co_Status");
            
            $contact->name2 = request("contact_nombre2");
            $contact->relationship2 = request("contact_relation2");
            $contact->telephone2 = request("contact_phone2");
            $contact->city2 = request("contact_living2");
            $contact->statusMigratory2 = request("co_Status2");

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

    protected function saveProcedure(){
        $procedure = procedure::find(request("pro_Id"));
        $procedure->ocupation = request("pro_ocupation");
        $procedure->save();        
        $idProcedure = $procedure->id;
        return $idProcedure;


    }

    protected function saveEducation(){

        // try{
            $education = education::find(request("education_edId"));

            $education->school = request("education_name");
            $education->city = request("education_city");
            $education->admissionDate = request("education_ingress");
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
            $job->dateInit = request("job_DateInit");            
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

    protected function saveHistoryJob(){

        // try{
            $hijo = HistoryJob::find(request("hijo_Id"));

            $hijo->history = request("hijo_History");
            $hijo->companyName = request("hijo_Name");
            $hijo->companyAdress = request("hijo_Direccion");            
            $hijo->bossName = request("hijo_Boss");
            $hijo->companyPhone = request("hijo_Phone");
            $hijo->datestart = request("hijo_Date");            
            $hijo->note = request("hijo_Note");            
            $hijo->save();        
            $idhijo = $hijo->id;
    
            return $idhijo;
            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveProcedure2(){

        // try{
            $procedure = procedure::find(request("pro_Id"));
            $procedure->passport = request("pr_Passport");
            $procedure->passportExpedition = request("pr_PassportExped");
            $procedure->passportExpiration = request("pr_PassportExpi");
            $procedure->passportCity = request("pr_PassportCity");
            $procedure->solicitante = request("pr_PassSoli");
            $procedure->visaType = request("pr_VisaType");
            $procedure->visaDelivery = request("pr_VisaDateDelivery");
            $procedure->visaNeg = request("pr_VisaDateNeg");                        
            $procedure->visaLostDate = request("prv_VisaLostDate");
            $procedure->visaLostDes = request("prv_VisaLostDescription");            
            $procedure->deporteeDate = request("prv_DeporteeDate");            
            $procedure->deportee = request("prv_DeporteeDesc");            
            $procedure->prvVisaLostQues = request("pr_VisaRobada");    
            $procedure->prvDeporteeQues = request("pr_Deportee");    

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

    protected function saveTravel(){

        // try{
            $travel = travel::find(request("tra_Id"));
            $travel->purpose = request("tra_purpose");

            $travel->planning = request("typePlaning");
            $travel->dateReservation = request("tra_DateReservation");
            $travel->numReservation = request("tra_NumReservation");
            $travel->date = request("tra_Date");        
            $travel->visitCities = request("tra_Cities");
            $travel->adressContact = request("tra_AdressContact");                        
            $travel->nameContact = request("tra_NameContact");
            $travel->relationContact = request("tra_RelationContact");            
            $travel->phoneContact = request("tra_PhoneContact");            
            $travel->situationContact = request("tra_SituationContact");                        
            $travel->payAdress = request("tra_PayAdress");            
            $travel->payName = request("tra_PayName");            
            $travel->payRelation = request("tra_PayRelation");            
            $travel->payPhone = request("tra_PayPhone");                                 
            $travel->companionName = request("tra_CompanionName");            
            $travel->companionRelation = request("tra_CompanionRelation");   
            $travel->arreglo = request("tra_Planing");   
            $travel->traVisitContactQues = request("tra_Visit");   
            $travel->traPaymeQues = request("tra_Pay");   
            $travel->traFriendQues = request("tra_Companion");   


            $travel->save();        
            $idTravel = $travel->id;
            return $idTravel;

            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveBackground(){

        // try{
            $background = background::find(request("bac_Id"));
          
            $background->legal = request("bac_Legal");            
            
            $background->timeAprox1 = request("bac_TimeAprox1");            
            $background->date1 = request("bac_DateAprox1");            
            $background->timeAprox2 = request("bac_TimeAprox2");            
            $background->date2 = request("bac_DateAprox2");            
            $background->timeAprox3 = request("bac_TimeAprox3");            
            $background->date3 = request("bac_DateAprox3");            
            $background->timeAprox4 = request("bac_TimeAprox4");            
            $background->date4 = request("bac_DateAprox4");            
            $background->bacVisitEU = request("back_history");            
            


            $background->save();        
            $idBackground = $background->id;
            return $idBackground;

            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }

    protected function saveAdditional2(){

        // try{
            $info = AdditionalInfo::find(request("inf_Id"));
          
            $info->visitCountry = request("inf_Countries");            
            
            $info->languages = request("inf_Idiomas");            
            $info->weapons = request("infoWeapons");            
            $info->weaponsInfo = request("info_WeaponsInfo");            
            $info->arrested = request("inf_Arrested");            
            $info->facebook = request("inf_Facebook");            
            $info->flickr = request("inf_Flickr");            
            $info->instagram = request("inf_Instagram");            
            $info->linkedin = request("inf_Linkedin");            
            $info->myspace = request("inf_MySpace");            
            $info->tumblr = request("inf_Tumlr");            
            $info->twitter = request("inf_Twitter");            
            $info->vine = request("inf_Vine");            
            $info->youtube = request("inf_Youtube");            
            $info->pinterest = request("inf_Pinterest");            
            $info->reddit = request("inf_Reddit");                        
            


            $info->save();        
            $idInfo = $info->id;
            return $idInfo;

            // Session::set('id_User', $idUser);
            // session()->put('idUser', $idUser);
        // }
        // catch(\Exception $e){
        //     return "";
        // }
    }




    
}
