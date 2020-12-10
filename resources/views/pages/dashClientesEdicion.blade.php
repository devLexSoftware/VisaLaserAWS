@extends('layouts.dashboard')

@section('content')

 
<div id="content-wrapper" class="d-flex flex-column">


<div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="row">
            <div class="col-md-12">
                <h3>Edicion en cliente</h3>
            </div>      
        </div>  
    
        <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>    
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-size:20px;">Opción</span>          
                </a>        
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">                    
                    <a class="dropdown-item" href="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>  
  
    @if(Session::has('success'))
    <div class="alert alert-info">
        {{Session::get('success')}}
    </div>
    @endif

    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Cliente</h1>
        <p class="mb-4"> Edición cliente</a></p>
    
        <form action="/clientesEdicion/1" method="POST" >
            {{ csrf_field() }}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información de pago</h6>
                </div>
                <div class="card-body">
                    <div class="panel-body">

                        <div class="row">                    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Total $$<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->trCurrency}}"  type="text" class="form-control" id="basic_total" name="basic_total" aria-describedby="" placeholder="Nombre(s)">                                
                                </div>
                            </div>                                  
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Fecha registro<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->trdate}}" type="text" class="form-control" id="basic_date2" name="basic_date2" aria-describedby="" placeholder="Apellidos(s)">
                                </div>                
                            </div>                                  
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Status<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->trStatus}}" type="text" class="form-control" id="basic_status2" name="basic_status2" aria-describedby="" placeholder="Apellidos(s)">
                                </div>                
                            </div>  

                            <div class="col-md-3">
                                <div class="form-group">
                                @if($customer[0]->trStatus == "Sin Revisar")
                                    <label for="sel1">Cambiar estado a Revisado</label>
                                    <br>
                                    <input value="{{$customer[0]->trId}}" type="hidden" id="transaction_Id" name="transaction_Id">
                                    <input value="{{$customer[0]->usId}}" type="hidden" class="form-control" id="basic_usId2" name="basic_usId2" >
                                    <button id="inputSubmit" type="submit" class="btn btn-success">Cambiar</button>
                                    @endif
                                </div>                
                            </div>                  
                        </div>
                    </div>
                </div>    
            </div>
        </form>

        <form action="/clientesEdicion/2" method="POST" >
            {{ csrf_field() }}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos generales</h6>
                </div>
                <div class="card-body">
                    <div class="panel-body">    
                                                                                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                                    <input title="No se aceptan números" value="{{$customer[0]->cuFirst}}" required  type="text" class="form-control" id="basic_nombre" name="basic_nombre" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->curId}}" required type="hidden" class="form-control" id="basic_cuId" name="basic_cuId" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->prId}}" required type="hidden" class="form-control" id="basic_prId" name="basic_prId" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->usId}}" required type="hidden" class="form-control" id="basic_usId" name="basic_usId" aria-describedby="" placeholder="Nombre(s)">
                                </div>
                            </div>                                  
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Apellido Paterno del solicitante<span class="star"> *</span></label>                                
                                    <input pattern="[a-zA-Z]+" title="No se aceptan números" value="{{$customer[0]->cuLast}}" required type="text" class="form-control" id="basic_apellidoPaterno" name="basic_apellidoPaterno" aria-describedby="" placeholder="Apellido">
                                </div>                
                            </div>                    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Apellido Materno del solicitante<span class="star"> *</span></label>                                
                                    <input pattern="[a-zA-Z]+" title="No se aceptan números" value="{{$customer[0]->cuLastMother}}" required type="text" class="form-control" id="basic_apellidoMaterno" name="basic_apellidoMaterno" aria-describedby="" placeholder="Apellido">
                                </div>                
                            </div>                                  
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Correo electronico<span class="star"> *</span></label>
                                    <input readonly value="{{$customer[0]->usEmail}}" required type="email" class="form-control" id="basic_email" name="basic_email" aria-describedby="emailHelp" placeholder="Email">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Nueva contraseña</label>
                                    <input onblur="checkPassword()" type="password" class="form-control" id="basic_password1" name="basic_password1" aria-describedby="emailHelp" placeholder="Password">
                                    <small class="form-text text-muted" style="color: #3e88bd">Solo llene los campos si desea cambiar su contraseña</small>

                                </div>
                            </div>           
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Verificar nueva contraseña</label>
                                    <input onblur="checkPassword()" type="password" class="form-control" id="basic_password2" name="basic_password2" aria-describedby="emailHelp" placeholder="Verificar password">
                                </div>
                            </div>                                                    
                                                        
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha nacimiento<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->cuBirthday}}"  required required type="date" class="form-control" id="basic_birthday" name="basic_birthday" aria-describedby="emailHelp" placeholder="Fecha">
                                    <input  type="hidden" id="in_year" name="in_year">

                                </div>
                            </div>    

                            @if($customer[0]->cuSex != "")
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Sexo<span class="star"> *</span></label>
                                <select class="form-control" id="basic_sex" required name="basic_sex" value="{{$customer[0]->cuSex}}">
                                    <option value="{{$customer[0]->cuSex}}" selected>{{$customer[0]->cuSex}}</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>                                    
                                </div>
                            </div>   
                            @else
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Sexo<span class="star"> *</span></label>
                                <select class="form-control" id="basic_sex" required name="basic_sex" value="{{$customer[0]->cuSex}}">
                                    <option style="display:none;">Default</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>                                    
                                </div>
                            </div>   
                            @endif

                            

                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">Telefono<span class="star">*</span></label>
                                    <input pattern="[1-9]{1}[0-9]{9}" title="Ingresa 10 dígitos" value="{{$customer[0]->cuTelephone}}" required required type="text" class="form-control" id="basic_phone" name="basic_phone" aria-describedby="emailHelp" placeholder="Telefono">
                                </div>
                            </div>                                                               
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">Móvil<span class="star">*</span></label>
                                    <input pattern="[1-9]{1}[0-9]{9}" title="Ingresa 10 dígitos" value="{{$customer[0]->cuMovil}}" required required type="text" class="form-control" id="basic_movil" name="basic_movil" aria-describedby="emailHelp" placeholder="Telefono">
                                </div>
                            </div>  
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">Trabajo<span class="star">*</span></label>
                                    <input  title="Ingresa 10 dígitos" value="{{$customer[0]->cuWorkPhone}}" required required type="text" class="form-control" id="basic_workphone" name="basic_workphone" aria-describedby="emailHelp" placeholder="Num (Ext)">
                                </div>
                            </div>                                                                 
                        </div>
                        <hr>
                        <br>
                        <h4>Dirección</h4>                                     
                      
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Calle</label>
                                    <input  value="{{$customer[0]->cuStreet}}" type="text" class="form-control" id="basic_street" name="basic_street" aria-describedby="emailHelp" placeholder="Calle">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Num Ext.</label>
                                    <input  value="{{$customer[0]->cunumExt}}" type="text" class="form-control" id="basic_numExt" name="basic_numExt" aria-describedby="emailHelp" placeholder="#">
                                </div>
                            </div>                                 
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="sel1">Num Int.</label>
                                    <input  value="{{$customer[0]->cunumInt}}" type="text" class="form-control" id="basic_numInt" name="basic_numInt" aria-describedby="emailHelp" placeholder="#">
                                </div>
                            </div>                                                                           
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Estado</label>
                                    <input  value="{{$customer[0]->cuState}}" type="text" class="form-control" id="basic_state" name="basic_state" aria-describedby="emailHelp" placeholder="Estado">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Ciudad</label>
                                    <input  value="{{$customer[0]->cuCity}}" type="text" class="form-control" id="basic_city" name="basic_city" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>                                 
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="sel1">C.P.</label>
                                    <input  value="{{$customer[0]->cuCP}}" type="number" class="form-control" id="basic_cp" name="basic_cp" aria-describedby="emailHelp" placeholder="00000">
                                </div>
                            </div>                                                                           
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="sel1">Colonia</label>
                                    <input  value="{{$customer[0]->cuSubur}}" type="text" class="form-control" id="basic_colonia" name="basic_colonia" aria-describedby="emailHelp" placeholder="Colonia">
                                </div>
                            </div>                                                                           
                        </div>                    

                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Contactos</h6>
                </div>
                <div class="card-body">
                    <div class="panel-body">    
                    
                        <h4>Cónyuge o Pareja</h4>    

                        <div class="row">
                            <input value="{{$customer[0]->prId}}"  required type="hidden" class="form-control" id="pr_Id3" name="pr_Id3" aria-describedby="" placeholder="Nombre(s)">

                            @if($customer[0]->prCivil != "")
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Estado civil<span class="star"> *</span></label>
                                <select class="form-control" id="pr_Civil" required name="pr_Civil" value="{{$customer[0]->prCivil}}" onchange="openOption('conyugue')">
                                    <option value="{{$customer[0]->prCivil}}" selected>{{$customer[0]->prCivil}}</option>
                                    <option value="Soltero(Nunca casado)">Soltero(Nunca casado)</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Viudo">Viudo</option>
                                    <option value="Separado">Separado</option>
                                </select>                                    
                                </div>
                            </div>   
                            @else
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Estado civil<span class="star"> *</span></label>
                                <select class="form-control" id="pr_Civil" required name="pr_Civil" onchange="openOption('conyugue')">
                                    <option style="display:none;">Default</option>
                                    <option value="Soltero(Nunca casado)">Soltero(Nunca casado)</option>
                                    <option value="Casado">Casado</option>
                                    <option value="Viudo">Viudo</option>
                                    <option value="Separado">Separado</option>
                                </select>                                    
                                </div>
                            </div>   
                            @endif
                        </div> 
                                 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->spName}}" required  type="text" class="form-control" id="married_nombre" name="married_nombre" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->spId}}"  required type="hidden" class="form-control" id="married_spId" name="married_spId" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                                              
                        </div>                        

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha nacimiento</label>
                                    <input value="{{$customer[0]->spBirthday}}" type="date" class="form-control" id="married_birthday" name="married_birthday" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Lugar de nacimiento</label>
                                    <input value="{{$customer[0]->spBirthdayPlace}}" type="text" class="form-control" id="married_place" name="married_place" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Lugar donde vive</label>
                                    <input value="{{$customer[0]->spLiving}}" type="text" class="form-control" id="married_living" name="married_living" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha de matrimonio</label>
                                    <input value="{{$customer[0]->spMarryDate}}" type="date" class="form-control" id="married_dateMarriend" name="married_dateMarriend" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>   
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Domicilio del Cónyuge o Pareja.</label>
                                    <input value="{{$customer[0]->spAdress}}" type="text" class="form-control" id="married_adress" name="married_adress" aria-describedby="emailHelp" placeholder="Dirección">
                                </div>
                            </div>   

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha de divorcio (Si Aplica)</label>
                                    <input value="{{$customer[0]->spDivorcied}}" type="date" class="form-control" id="married_dateDivorced" name="married_dateDivorced" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>                               
                        </div>
                        <hr>  

                        <h4>Contactos</h4>                                     
                        <label for="sel1">Contacto 1</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coName}}" required type="text" class="form-control" id="contact_nombre" name="contact_nombre" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->coId}}"  type="hidden" class="form-control" id="contact_coId" name="contact_coId" aria-describedby="" placeholder="Nombre(s)">
                                </div>
                            </div>    

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Estatus Migratorio</label> <span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coStatus}}" required type="text" class="form-control" id="co_Status" name="co_Status" placeholder="Estatus">
                                </div>
                            </div>    
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Relación</label> <span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coRelationship}}" required type="text" class="form-control" id="contact_relation" name="contact_relation" aria-describedby="emailHelp" placeholder="Estatus">
                                </div>
                            </div>    

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Telefono</label>
                                    <input value="{{$customer[0]->coTelephone}}" type="text" class="form-control" id="contact_phone" name="contact_phone" aria-describedby="emailHelp" placeholder="Telefono">
                                </div>
                            </div>    

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Ciudad donde vive</label>
                                    <input value="{{$customer[0]->coCity}}" type="text" class="form-control" id="contact_living" name="contact_living" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>                                
                        </div>

                        <label for="sel1">Contacto 2</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coName2}}" required type="text" class="form-control" id="contact_nombre2" name="contact_nombre2" aria-describedby="" placeholder="Nombre(s)">                                    
                                </div>
                            </div>              
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Estatus Migratorio</label> <span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coStatus2}}" required type="text" class="form-control" id="co_Status2" name="co_Status2" placeholder="Estatus">
                                </div>
                            </div>                        
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Relación</label> <span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coRelationship2}}" required type="text" class="form-control" id="contact_relation2" name="contact_relation2" aria-describedby="emailHelp" placeholder="Relación">
                                </div>
                            </div>    

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Telefono</label>
                                    <input value="{{$customer[0]->coTelephone2}}" type="text" class="form-control" id="contact_phone2" name="contact_phone2" aria-describedby="emailHelp" placeholder="Telefono">
                                </div>
                            </div>    

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Ciudad donde vive</label>
                                    <input value="{{$customer[0]->coCity2}}" type="text" class="form-control" id="contact_living2" name="contact_living2" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>                                
                        </div>
                        <hr>                            
                        <h4>Padres</h4>                                         
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Nombre de la madre<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->paNameMother}}" required type="text" class="form-control" id="parent_nameMother" name="parent_nameMother" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->paId}}"  type="hidden" class="form-control" id="parent_paId" name="parent_paId" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>    
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">¿Vive en E.U.?</label>
                                    <input value="{{$customer[0]->paLiveMother}}" type="text" class="form-control" id="parent_paLiveMother" name="parent_paLiveMother" aria-describedby="" placeholder="">
                                </div>                
                            </div>                                                               
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">Estado migratorio</label>
                                    <input value="{{$customer[0]->paStatusMigratoryMother}}" type="text" class="form-control" id="parent_motherStatus" name="parent_motherStatus" aria-describedby="" placeholder="Estado">
                                </div>                
                            </div>    
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">Fecha de nacimiento </label>
                                    <input value="{{$customer[0]->paBirthdayMother}}" type="date" class="form-control" id="parent_motherBirthday" name="parent_motherBirthday" aria-describedby="" placeholder="Fecha">
                                </div>                
                            </div>                                  
                        </div>     
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Nombre del padre<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->paNameFather}}" required type="text" class="form-control" id="parent_nameFather" name="parent_nameFather" aria-describedby="" placeholder="Nombre(s)">
                                </div>
                            </div>    
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">¿Vive en E.U.?</label>
                                    <input value="{{$customer[0]->paLiveFather}}" type="text" class="form-control" id="parent_paLiveFather" name="parent_paLiveFather" aria-describedby="" placeholder="">
                                </div>                
                            </div>                                  
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">Estado migratorio</label>
                                    <input value="{{$customer[0]->paStatusMigratoryFather}}" type="text" class="form-control" id="parent_fatherStatus" name="parent_fatherStatus" aria-describedby="" placeholder="Estado">
                                </div>                
                            </div>       
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="sel1">Fecha de nacimiento</label>
                                    <input value="{{$customer[0]->paBirthdayFather}}" type="date" class="form-control" id="parent_fatherBirthday" name="parent_fatherBirthday" aria-describedby="" placeholder="Fecha">
                                </div>                
                            </div>                                  
                        </div>     
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Educación y Laboral</h6>
                </div>
                <div class="card-body">
                    <div class="panel-body">    
                        <h4>Educación</h4>             
                                                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1">Ocupación o actividad del solicitante</label>
                                    <input value="{{$customer[0]->proOcupation}}" type="text" class="form-control" id="pro_ocupation" name="pro_ocupation" aria-describedby="" placeholder="Ocupación">                                    
                                    <input value="{{$customer[0]->prId}}"  type="hidden" class="form-control" id="pro_Id" name="pro_Id" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                                                                                                                                   
                        </div>
                        
                                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Nombre de la empresa</label>
                                    <input value="{{$customer[0]->joCompany}}" type="text" class="form-control" id="job_name" name="job_name" aria-describedby="" placeholder="Nombre">
                                    <input value="{{$customer[0]->joId}}"  type="hidden" class="form-control" id="job_id" name="job_id" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div> 
                                                                
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="sel1">Dirección de la empresa</label>
                                    <input value="{{$customer[0]->joAddress}}" type="text" class="form-control" id="job_direction" name="job_direction" aria-describedby="" placeholder="Dirección">
                                </div>                
                            </div>                                                              
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="sel1">Principales actividades</label>
                                    <input value="{{$customer[0]->joActivities}}" type="text" class="form-control" id="job_activities" name="job_activities" aria-describedby="" placeholder="Actividades">
                                </div>                
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Puesto de la empresa</label>
                                    <input value="{{$customer[0]->joOcupation}}" type="text" class="form-control" id="job_ocupation" name="job_ocupation" aria-describedby="" placeholder="Puesto">
                                </div>
                            </div>                                                                                 
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Ingreso mensual sin descuentos</label>
                                    <input value="{{$customer[0]->joSalary}}" type="text" class="form-control" id="job_salary" name="job_salary" aria-describedby="" placeholder="Salario">
                                </div>
                            </div> 
                                                                
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Fecha en que inicio</label>
                                    <input value="{{$customer[0]->jobDateInit}}" type="date" class="form-control" id="job_DateInit" name="job_DateInit" placeholder="Fecha">
                                </div>                
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">¿Tiene usted más de 5 años laborando en su empleo actual?</label>  
                                    <input value="{{$customer[0]->hijoId}}"  type="hidden" class="form-control" id="hijo_Id" name="hijo_Id" aria-describedby="" placeholder="Nombre(s)">
                                    

                                    @if($customer[0]->hijoHistory != null)
                                        <select class="form-control" id="hijo_History" name="hijo_History"  >
                                            <option value="{{$customer[0]->hijoHistory}}" selected><?php echo $customer[0]->hijoHistory; ?></option>                                    
                                                                                                                              
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="hijo_History" name="hijo_History">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>                                                         
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div  class="form-group" id="hijo_NameLabel" name="hijo_NameLabel">
                                    <label for="sel1">Nombre de la empresa anterior</label>
                                    <input  value="{{$customer[0]->hijoName}}" type="text" class="form-control" id="hijo_Name" name="hijo_Name" placeholder="Nombre">
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group"  id="hijo_DireccionLabel" name="hijo_DireccionLabel">
                                    <label for="sel1">Dirección de la empresa anterior</label>
                                    <input  value="{{$customer[0]->hijoDireccion}}" type="text" class="form-control" id="hijo_Direccion" name="hijo_Direccion" placeholder="Dirección">
                                </div>
                            </div> 
                        </div> 

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"  id="hijo_BossLabel" name="hijo_BossLabel">
                                    <label for="sel1">Nombre de tu jefe inmediato</label>
                                    <input value="{{$customer[0]->hijoBoss}}" type="text" class="form-control" id="hijo_Boss" name="hijo_Boss" placeholder="Nombre">
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group" id="hijo_PhoneLabel" name="hijo_PhoneLabel">
                                    <label for="sel1">Número telefónico</label>
                                    <input value="{{$customer[0]->hijoPhone}}" type="number" class="form-control" id="hijo_Phone" name="hijo_Phone" placeholder="Telefóno">
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div  class="form-group" id="hijo_DateLabel" name="hijo_DateLabel">
                                    <label for="sel1">Fecha en la que inicio</label>
                                    <input  value="{{$customer[0]->hijoDate}}" type="date" class="form-control" id="hijo_Date" name="hijo_Date" placeholder="Telefóno">
                                </div>
                            </div> 
                        </div> 

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="hijo_NoteLabel" name="hijo_NoteLabel">
                                    <label for="sel1">Describa brevemente su actividad en este empleo.</label>
                                    <input  value="{{$customer[0]->hijoNote}}" type="text" class="form-control" id="hijo_Note" name="hijo_Note" placeholder="Actividades">
                                </div>
                            </div> 
                        </div> 

                        <hr>
                        <br>
                        <h4>Educación</h4>             
                                                    
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Ultimo grado de estudios<span class="star"> *</span></label>
                                    <!-- <input value="{{$customer[0]->edLevel}}" required type="text" class="form-control" id="education_grade" name="education_grade" aria-describedby="" placeholder="Nombre"> -->
                                    <input value="{{$customer[0]->edId}}"  type="hidden" class="form-control" id="education_edId" name="education_edId" aria-describedby="" placeholder="Nombre(s)">


                                    @if($customer[0]->edLevel != "")                                    
                                        <select class="form-control" id="education_grade" required name="education_grade" value="{{$customer[0]->edLevel}}">
                                            <option value="{{$customer[0]->edLevel}}" selected>{{$customer[0]->edLevel}}</option>                                            
                                            <option value="Primaria">Primaria</option>
                                            <option value="Secundaria">Secundaria</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Universidad">Universidad</option>
                                            <option value="Postgrado">Postgrado</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="education_grade" required name="education_grade" value="{{$customer[0]->edLevel}}">
                                            <option style="display:none;">Default</option>
                                            <option value="Primaria">Primaria</option>
                                            <option value="Secundaria">Secundaria</option>
                                            <option value="Preparatoria">Preparatoria</option>
                                            <option value="Universidad">Universidad</option>
                                            <option value="Postgrado">Postgrado</option>
                                        </select>  
                                        @endif
                                </div>
                            </div> 
                                                                
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Fecha de ingreso</label>
                                    <input value="{{$customer[0]->edAdmission}}" type="date" class="form-control" id="education_ingress" name="education_ingress" aria-describedby="" placeholder="Fecha">
                                    <small class="form-text text-muted" style="color: #3e88bd">En esta cantidad, deberá de incluir los ingresos extras y no declarados</small>
                                </div>                
                            </div>                                  
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Fecha de egreso</label>
                                    <input value="{{$customer[0]->edEgress}}" type="date" class="form-control" id="education_egress" name="education_egress" aria-describedby="" placeholder="Fecha">
                                </div>                
                            </div>                                  
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Nombre del instituto de ultimo grado de estudios</label>
                                    <input value="{{$customer[0]->edSchool}}" type="text" class="form-control" id="education_name" name="education_name" aria-describedby="" placeholder="Nombre">
                                </div>
                            </div> 
                                                                
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="sel1">Si no recuerda la dirección de la institución, ingrese solo la ciudad</label>

                                    <input value="{{$customer[0]->edCity}}" type="text" class="form-control" id="education_city" name="education_city" aria-describedby="" placeholder="Ciudad">
                                </div>                
                            </div>                                                              
                        </div>

                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">VISA/Passaporte</h6>
                </div>
                <div class="card-body">
                    <div class="panel-body">    


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">N° Pasaporte<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->prPassport}}" required  type="text" class="form-control" id="pr_Passport" name="pr_Passport" aria-describedby="" >                                                                        
                                    <input value="{{$customer[0]->prId}}"  type="hidden" class="form-control" id="pro_Id" name="pro_Id" aria-describedby="" placeholder="Nombre(s)">
                                    
                                </div>
                            </div>                                  
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha de Expedición<span class="star"> *</span></label>                                
                                    <input value="{{$customer[0]->prPassportExpedition}}"  required  type="date" class="form-control" id="pr_PassportExped" name="pr_PassportExped" placeholder="Fecha">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha de Vencimiento<span class="star"> *</span></label>                                
                                    <input value="{{$customer[0]->prPassportExpiration}}"  required  type="date" class="form-control" id="pr_PassportExpi" name="pr_PassportExpi" placeholder="Fecha">                                    
                                </div>                
                            </div>                                  
                        </div>

                        <div class="row">                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Cuidad de Expedición del Pasaporte<span class="star"> *</span></label>                                
                                    <input value="{{$customer[0]->prPassportCity}}"  required  type="text" class="form-control" id="pr_PassportCity" name="pr_PassportCity" placeholder="Ciudad">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-3">
                                <label for="sel1">¿Eres el solicitante de la VISA?<span class="star"> *</span></label>                                

                                @if($customer[0]->prSolicitante != "")                                    
                                        <select class="form-control" id="pr_PassSoli" required name="pr_PassSoli" value="{{$customer[0]->prSolicitante}}" >
                                            <option value="{{$customer[0]->prSolicitante}}" selected>{{$customer[0]->prSolicitante}}</option>                                                                                        
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="pr_PassSoli" required name="pr_PassSoli">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif                                
                            </div>                                  
                        </div>
                        
                        <hr>
                        <h4>Si has tenido VISA anteriormente, complete los siguientes campos</h4>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Tipo de VISA</label>
                                    <input value="{{$customer[0]->prVisaType}}"  type="text" class="form-control" id="pr_VisaType" name="pr_VisaType" aria-describedby="" placeholder="VISA">                                                                        
                                </div>
                            </div>                                  
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha en la que se entregó la VISA</label>                                                                    
                                    <input value="{{$customer[0]->prvisaDelivery}}"  type="date" class="form-control" id="pr_VisaDateDelivery" name="pr_VisaDateDelivery" placeholder="Fecha">                                    
                                    <small class="form-text text-muted" style="color: #3e88bd">Si no recuerda la fecha exacta, introduzca la fecha aproximada</small>
                                </div>                
                            </div>                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Si te han negado la VISA, menciona la fecha aprox. en que sucedió.</label>                                
                                    <input value="{{$customer[0]->prvisaNeg}}"   type="date" class="form-control" id="pr_VisaDateNeg" name="pr_VisaDateNeg" placeholder="Fecha">                                    
                                </div>                
                            </div>                                  
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Te ha sucedido lo siguiente? (Robada,Extraviada o Cancelada)</label>                                    
                                        @if($customer[0]->prvVisaLostQues != "")                                    
                                            <select class="form-control" id="pr_VisaRobada" required name="pr_VisaRobada" onchange="openOption('VisaRobadaExtraviada')">                                                
                                                <option value="{{$customer[0]->prvVisaLostQues}}" selected>{{$customer[0]->prvVisaLostQues}}</option>                                                                                        
                                                <option value="Si">Si</option>                                            
                                                <option value="No">No</option>
                                            </select>                                                                             
                                        @else
                                            <select class="form-control" id="pr_VisaRobada" required name="pr_VisaRobada" onchange="openOption('VisaRobadaExtraviada')">
                                                <option style="display:none;">Default</option>                                            
                                                <option value="Si">Si</option>                                            
                                                <option value="No">No</option>
                                            </select>  
                                        @endif                                
                                </div>
                            </div>                                                              
                            <div class="col-md-3">
                                <div   class="form-group" id="prv_VisaLostDateLabel" name="prv_VisaLostDateLabel">
                                    <label for="sel1">Fecha aproximada en que sucedió.</label>                                
                                                                   
                                    <input value="{{$customer[0]->prvVisaLostDate}}"  type="date" class="form-control" id="prv_VisaLostDate" name="prv_VisaLostDate" placeholder="Fecha">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-6">
                                <div class="form-group" id="prv_VisaLostDescriptionLabel" name="prv_VisaLostDescriptionLabel">
                                <label for="sel1">Descripción breve del Incidente.</label>                                
                                                                 
                                    <textarea  value="{{$customer[0]->prvVisaLostDesc}}" class="form-control" id="prv_VisaLostDescription" name="prv_VisaLostDescription" placeholder="Descripción">{{$customer[0]->prvVisaLostDesc}}</textarea>
                                </div>                
                            </div>                                  
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Te han negado la entrada, VISA o has sido deportado de los Estados Unidos?</label>                                    
                                        @if($customer[0]->prvDeporteeQues != "")                                    
                                            <select class="form-control" id="pr_Deportee" required name="pr_Deportee" onchange="openOption('VisaNegadaDeportado')">
                                                <option value="{{$customer[0]->prvDeporteeQues}}" selected>{{$customer[0]->prvDeporteeQues}}</option>                                                                                        
                                                <option value="Si">Si</option>                                            
                                                <option value="No">No</option>
                                            </select>                                                                             
                                        @else
                                            <select class="form-control" id="pr_Deportee" required name="pr_Deportee" onchange="openOption('VisaNegadaDeportado')">
                                                <option style="display:none;">Default</option>                                            
                                                <option value="Si">Si</option>                                            
                                                <option value="No">No</option>
                                            </select>  
                                        @endif                                
                                </div>
                            </div>                                                              
                            <div class="col-md-3">
                                <div  class="form-group" id="prv_DeporteeDateLabel" name="prv_DeporteeDateLabel">
                                    <label for="sel1">Fecha en que sucedió.</label>                                
                                    <input  value="{{$customer[0]->prvDeporteeDate}}"  type="date" class="form-control" id="prv_DeporteeDate" name="prv_DeporteeDate" placeholder="Fecha">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-6">
                                <div class="form-group" id="prv_DeporteeDescLabel" name="prv_DeporteeDescLabel">
                                    <label for="sel1">Descripción</label>                                
                                    <textarea  value="{{$customer[0]->prvDeporteeDesc}}" class="form-control" id="prv_DeporteeDesc" name="prv_DeporteeDesc" placeholder="Descripción">{{$customer[0]->prvDeporteeDesc}}</textarea>                                    
                                </div>                
                            </div>                                  
                        </div>

                    </div>
                </div>
            </div>



            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Viaje Planeado</h6>
                </div>
                <div class="card-body">
                    <div class="panel-body"> 
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Escribe el Propósito del viaje a Estados Unidos</label>
                                    <textarea value="{{$customer[0]->traPurpose}}"  class="form-control" id="tra_purpose" name="tra_purpose" placeholder="Ciudad(es)">{{$customer[0]->traPurpose}}</textarea>
                                    <input value="{{$customer[0]->traId}}"  type="hidden" class="form-control" id="tra_Id" name="tra_Id" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                                                                                                                          
                        </div>

                        <div class="row">                                                        
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Has hecho arreglos del viaje?<span class="star"> *</span></label>                                
                                    @if($customer[0]->traArreglo != "")                                    
                                        <select class="form-control" id="tra_Planing" name="tra_Planing"  value="Si">
                                            <option value="{{$customer[0]->traArreglo}}" selected>{{$customer[0]->traArreglo}}</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="tra_Planing" name="tra_Planing" onchange="openOption('travelPlaning')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>    
                            <div class="col-md-3">
                                <div class="form-group" id="tra_PlaningLabel" name="tra_PlaningLabel">
                                    <label for="sel1">¿Tipo de transporte?<span class="star"> *</span></label>                                
                                    @if($customer[0]->traPlanning != "")                                    
                                        <select class="form-control" id="typePlaning" name="typePlaning"  value="{{$customer[0]->traPlanning}}">
                                            <option value="{{$customer[0]->traPlanning}}" selected>{{$customer[0]->traPlanning}}</option>                                                                                                                                                                                                                          
                                            <option value="Embarcación">Embarcación</option>                                            
                                            <option value="Línea Aérea">Línea Aérea</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="typePlaning" name="typePlaning">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Embarcación">Embarcación</option>                                            
                                            <option value="Línea Aérea">Línea Aérea</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>     
                            <div class="col-md-3">
                                <div class="form-group" id="tra_DateReservationLabel" name="tra_DateReservationLabel">
                                    <label for="sel1">Fecha de Reservación.</label>                                
                                    <input value="{{$customer[0]->traDateReservation}}"  type="date" class="form-control" id="tra_DateReservation" name="tra_DateReservation" placeholder="Fecha">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-3">
                                <div class="form-group" id="tra_NumReservationLabel" name="tra_NumReservationLabel">
                                    <label >Número de Reservación.</label>                                
                                    <input value="{{$customer[0]->traNumReservation}}" type="text" class="form-control" id="tra_NumReservation" name="tra_NumReservation" placeholder="Número">
                                </div>                
                            </div>                                                                              
                        </div>
                        <hr>

                        <div class="row">               
                            <div class="col-md-3">
                                <div  class="form-group" id="tra_date" >
                                    <label for="sel1">Fecha aproximada en que tienes programada la visita.</label>                                
                                    <input value="{{$customer[0]->traDate}}"  type="date" class="form-control" id="tra_Date" name="tra_Date" placeholder="Fecha">                                    
                                </div>                
                            </div>                                                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Usted visitará algún familiar, amigo o empresa?</label>                                
                                    @if($customer[0]->traVisitContactQues != "")                                    
                                        <select class="form-control" id="tra_Visit" name="tra_Visit"  onchange="openOption('travelVisit')">
                                            <option value="{{$customer[0]->traVisitContactQues}}" selected>{{$customer[0]->traVisitContactQues}}</option>
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="tra_Visit" name="tra_Visit" onchange="openOption('travelVisit')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>      
                            <div class="col-md-6">
                                <div class="form-group" id="tra_CitiesLabel" name="tra_CitiesLabel">
                                    <label for="sel1">Ciudades que visitara.</label>                                
                                    <textarea value="{{$customer[0]->traVisitCities}}" class="form-control" id="tra_Cities" name="tra_Cities" >{{$customer[0]->traVisitCities}}</textarea>
                                </div>                
                            </div>    
                        </div>

                        <label id="tra_ContactLabel" name="tra_ContactLabel">Información sobre el contacto de E.U.</label>       
                        <div class="row">                                                                                                       
                            <div class="col-md-3">
                                <div class="form-group" id="tra_AdressContactLabel" name="tra_AdressContactLabel">
                                    <label for="sel1">Dirección </label>                                
                                    <input value="{{$customer[0]->traAdressContact}}" type="text" class="form-control" id="tra_AdressContact" name="tra_AdressContact" placeholder="Dirección">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="tra_NameContactLabel" name="tra_NameContactLabel">
                                    <label for="sel1">Nombre </label>                                
                                    <input value="{{$customer[0]->traNameContact}}" type="text" class="form-control" id="tra_NameContact" name="tra_NameContact" placeholder="Nombre">
                                </div>                
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" id="tra_RelationContactLabel" name="tra_RelationContactLabel">
                                    <label for="sel1">Relación </label>                                
                                    <input value="{{$customer[0]->traRelationContact}}" type="text" class="form-control" id="tra_RelationContact" name="tra_RelationContact" placeholder="Relación">
                                </div>                
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" id="tra_PhoneContactLabel" name="tra_PhoneContactLabel">
                                    <label for="sel1">Móvil </label>                                
                                    <input value="{{$customer[0]->traPhoneContact}}" type="number" class="form-control" id="tra_PhoneContact" name="tra_PhoneContact" placeholder="Telefono">
                                </div>                
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" id="tra_SituationContactLabel" name="tra_SituationContactLabel">
                                    <label for="sel1">Situación migratoria</label>                                
                                    <input value="{{$customer[0]->traSituationContact}}" type="text" class="form-control" id="tra_SituationContact" name="tra_SituationContact" placeholder="Situación">
                                </div>                
                            </div>
                        </div>
                        
                        <hr>
                        <br>
                        <div class="row">    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">¿Usted financiara su viaje?</label>                                
                                    @if($customer[0]->traPaymeQues != "")                                    
                                        <select class="form-control" id="tra_Pay" name="tra_Pay"  onchange="openOption('travelPay')">
                                            <option value="{{$customer[0]->traPaymeQues}}" selected>{{$customer[0]->traPaymeQues}}</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="tra_Pay" name="tra_Pay" onchange="openOption('travelPay')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>      
                        </div>      
                       
                        <label id="tra_PayLabel" name="tra_PayLabel">Información sobre la persona que financiara su viaje de E.U.</label>       
                        <div class="row">                                                                                                                                   
                            <div class="col-md-3">
                                <div class="form-group" id="tra_PayAdressLabel" name="tra_PayAdressLabel">
                                    <label for="sel1">Dirección </label>                                
                                    <input value="{{$customer[0]->traPayAdress}}" type="text" class="form-control" id="tra_PayAdress" name="tra_PayAdress" placeholder="Dirección">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="tra_PayNameLabel" name="tra_PayNameLabel">
                                    <label for="sel1">Nombre </label>                                
                                    <input value="{{$customer[0]->traPayName}}" type="text" class="form-control" id="tra_PayName" name="tra_PayName" placeholder="Nombre">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="tra_PayRelationLabel" name="tra_PayRelationLabel">
                                    <label for="sel1">Relación </label>                                
                                    <input value="{{$customer[0]->traPayRelation}}" type="text" class="form-control" id="tra_PayRelation" name="tra_PayRelation" placeholder="Relación">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="tra_PayPhoneLabel" name="tra_PayPhoneLabel">
                                    <label for="sel1">Número Telefónico </label>                                
                                    <input value="{{$customer[0]->traPayPhone}}" type="number" class="form-control" id="tra_PayPhone" name="tra_PayPhone" placeholder="Telefono">
                                </div>                
                            </div>                                    
                        </div>

                        
                        <div class="row">    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Viaja usted acompañado?</label>                                
                                    @if($customer[0]->traFriendQues != "")                                    
                                        <select class="form-control" id="tra_Companion"  name="tra_Companion" onchange="openOption('travelCompanion')">
                                            <option value="{{$customer[0]->traFriendQues}}" selected>{{$customer[0]->traFriendQues}}</option>                                                                                                                                                                           
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="tra_Companion" name="tra_Companion" onchange="openOption('travelCompanion')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                                                      
                            </div>    
                            <div class="col-md-3">
                                <div class="form-group" id="tra_CompanionNameLabel" name="tra_CompanionNameLabel">
                                    <label for="sel1">Nombre del acompañante </label>                                
                                    <input value="{{$customer[0]->traCompanionName}}" type="text" class="form-control" id="tra_CompanionName" name="tra_CompanionName" placeholder="Nombre">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="tra_CompanionRelationLabel" name="tra_CompanionRelationLabel">
                                    <label for="sel1">Relación del acompañante</label>                                
                                    <input value="{{$customer[0]->traCompanionRelation}}" type="text" class="form-control" id="tra_CompanionRelation" name="tra_CompanionRelation" placeholder="Relación">
                                </div>                
                            </div>  
                        </div>    

                        <hr>

                        <div class="row">    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Anteriormente has estado en E.U.?</label>                                
                                    @if($customer[0]->bacVisitEU != "")                                    
                                        <select class="form-control" id="back_history" name="back_history"  onchange="openOption('back')">
                                            <option value="{{$customer[0]->bacVisitEU}}" selected>{{$customer[0]->bacVisitEU}}</option>                                                                                                                                                                                                                                                                                                        
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="back_history" name="back_history" onchange="openOption('back')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                                                      
                            </div>    
                            <div class="col-md-3">
                                <div class="form-group" id="bac_LegalLabel" name="bac_LegalLabel">
                                    <label for="sel1">Ingresaste de forma legal o ilegal</label>                                
                                    @if($customer[0]->bacLegal != "")                                    
                                        <select class="form-control" id="bac_Legal" name="bac_Legal"  value="{{$customer[0]->bacLegal}}">
                                            <option value="{{$customer[0]->bacLegal}}" selected>{{$customer[0]->bacLegal}}</option>                                                                                        
                                            <option value="Legal">Legal</option>                                            
                                            <option value="Ilegal">Ilegal</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="bac_Legal" name="bac_Legal">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Legal">Legal</option>                                            
                                            <option value="Ilegal">Ilegal</option>
                                        </select>  
                                    @endif     
                                </div>                                                      
                            </div>                                
                        </div>      

                        <label id="bac_VisitHistory" name="bac_VisitHistory">Información sobre visitas anteriores a E.U.</label>       

                        <div class="row">                                                                                                                                   
                            <div class="col-md-3">
                                <div class="form-group" id="bac_TimeAprox1Label" name="bac_TimeAprox1Label">
                                    <label for="sel1">Duración del primer viaje</label>                                                                                                
                                    <input value="{{$customer[0]->bacTimeAprox1}}" type="text" class="form-control" id="bac_TimeAprox1" name="bac_TimeAprox1" placeholder="Duración">
                                    <input value="{{$customer[0]->bacId}}"  type="hidden" class="form-control" id="bac_Id" name="bac_Id" aria-describedby="" placeholder="Nombre(s)">

                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="bac_DateAprox1Label" name="bac_DateAprox1Label">
                                    <label for="sel1">Fecha del primer viaje</label>                                
                                    <input value="{{$customer[0]->bacDateAprox1}}" type="date" class="form-control" id="bac_DateAprox1" name="bac_DateAprox1" placeholder="Fecha">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="bac_TimeAprox2Label" name="bac_TimeAprox2Label">
                                    <label for="sel1">Duración del segundo viaje</label>                                
                                    <input value="{{$customer[0]->bacTimeAprox2}}" type="text" class="form-control" id="bac_TimeAprox2" name="bac_TimeAprox2" placeholder="Duración">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="bac_DateAprox2Label" name="bac_DateAprox2Label">
                                    <label for="sel1">Fecha del segundo viaje</label>                                
                                    <input value="{{$customer[0]->bacDateAprox2}}" type="date" class="form-control" id="bac_DateAprox2" name="bac_DateAprox2" placeholder="Fecha">
                                </div>                
                            </div>
                            
                            
                        </div>

                        <div class="row">                                                                                                                                   
                            <div class="col-md-3">
                                <div class="form-group" id="bac_TimeAprox3Label" name="bac_TimeAprox3Label">
                                    <label for="sel1">Duración del tercer viaje</label>                                                                                                
                                    <input value="{{$customer[0]->bacTimeAprox3}}" type="text" class="form-control" id="bac_TimeAprox3" name="bac_TimeAprox3" placeholder="Duración">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="bac_DateAprox3Label" name="bac_DateAprox3Label">
                                    <label for="sel1">Fecha del tercer viaje</label>                                
                                    <input value="{{$customer[0]->bacDateAprox3}}" type="date" class="form-control" id="bac_DateAprox3" name="bac_DateAprox3" placeholder="Fecha">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="bac_TimeAprox4Label" name="bac_TimeAprox4Label">
                                    <label for="sel1">Duración del cuarto viaje</label>                                                                                                                                      
                                    <input value="{{$customer[0]->bacTimeAprox4}}" type="text" class="form-control" id="bac_TimeAprox4" name="bac_TimeAprox4" placeholder="Duración">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="bac_DateAprox4Label" name="bac_DateAprox4Label">
                                    <label for="sel1">Fecha del cuarto viaje</label>                                
                                    <input value="{{$customer[0]->bacDateAprox4}}" type="date" class="form-control" id="bac_DateAprox4" name="bac_DateAprox4" placeholder="Fecha">
                                </div>                
                            </div>
                            
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información adicional</h6>
                </div>
                <div class="card-body">
                    <div class="panel-body"> 

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">¿Qué países has visitado en los últimos 5 años?</label>
                                    <textarea value="{{$customer[0]->infCountries}}"  class="form-control" id="inf_Countries" name="inf_Countries" placeholder="País(es)"><?php echo $customer[0]->infCountries ?></textarea>
                                    <input value="{{$customer[0]->infId}}"  type="hidden" class="form-control" id="inf_Id" name="inf_Id" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                                                                                                                          
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">¿Que idiomas domina?</label>
                                    <textarea value="{{$customer[0]->infIdiomas}}"  class="form-control" id="inf_Idiomas" name="inf_Idiomas" placeholder="Idioma(s)"><?php echo $customer[0]->infIdiomas?></textarea>
                                </div>
                            </div>                                                                                                                                          
                        </div>

                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Tiene habilidades con el uso de armas?</label>                                
                                    @if($customer[0]->infWeapons != "")                                    
                                        <select class="form-control" id="infoWeapons" name="infoWeapons" onchange="openOption('weapons')">
                                            <option value="{{$customer[0]->infWeapons}}" selected>{{$customer[0]->infWeapons}}</option>
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="infoWeapons" name="infoWeapons" onchange="openOption('weapons')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>        
                            </div>        
                            <div class="col-md-3">                                              
                                <div class="form-group" id="info_WeaponsInfoLabel" name="info_WeaponsInfoLabel">
                                        <label for="sel1">¿En donde recibió adiestramiento?</label>                                
                                        <input value="{{$customer[0]->infWeaponsInfo}}" type="text" class="form-control" id="info_WeaponsInfo" name="info_WeaponsInfo" placeholder="">
                                </div>   
                            </div>     
                            <div class="col-md-6">                                              
                                <div  class="form-group">
                                    <label for="sel1">Si usted ha sido arrestado por algún delito explique el por que.</label>                                
                                    <input  value="{{$customer[0]->infArrested}}" type="text" class="form-control" id="inf_Arrested" name="inf_Arrested" placeholder="">
                                </div>   
                            </div>                               
                        </div>

                        <div class="row">                                
                            <div class="col-md-2">                                              
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Facebook</label>                                
                                    <input value="{{$customer[0]->infFacebook}}" type="text" class="form-control" id="inf_Facebook" name="inf_Facebook" >
                                </div>   
                            </div>                               
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Flickr</label>                                
                                    <input value="{{$customer[0]->infFlickr}}" type="text" class="form-control" id="inf_Flickr" name="inf_Flickr" >
                                </div>   
                            </div>                               
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Instagram</label>                                
                                    <input value="{{$customer[0]->infInstagram}}" type="text" class="form-control" id="inf_Instagram" name="inf_Instagram" >
                                </div>   
                            </div>                               
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de LinkedIn</label>                                
                                    <input value="{{$customer[0]->infLinkedin}}" type="text" class="form-control" id="inf_Linkedin" name="inf_Linkedin" >
                                </div>   
                            </div>
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de MySpace</label>                                
                                    <input value="{{$customer[0]->infMySpace}}" type="text" class="form-control" id="inf_MySpace" name="inf_MySpace" >
                                </div>   
                            </div>

                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Tumblr</label>                                
                                    <input value="{{$customer[0]->infTumblr}}" type="text" class="form-control" id="inf_Tumlr" name="inf_Tumlr" >
                                </div>   
                            </div>
                        </div>
                        <div class="row">                                
                            <div class="col-md-2">                                              
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Twitter</label>                                
                                    <input value="{{$customer[0]->infTwitter}}" type="text" class="form-control" id="inf_Twitter" name="inf_Twitter" >
                                </div>   
                            </div>                               
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Vine</label>                                
                                    <input value="{{$customer[0]->infVine}}" type="text" class="form-control" id="inf_Vine" name="inf_Vine" >
                                </div>   
                            </div>                               
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Youtube</label>                                
                                    <input value="{{$customer[0]->infYoutube}}" type="text" class="form-control" id="inf_Youtube" name="inf_Youtube" >
                                </div>   
                            </div>                               
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Pinterest</label>                                
                                    <input value="{{$customer[0]->infPinterest}}" type="text" class="form-control" id="inf_Pinterest" name="inf_Pinterest" >
                                </div>   
                            </div>
                            <div class="col-md-2">                                             
                                <div  class="form-group" >
                                    <label for="sel1">Usuario de Reddit</label>                                
                                    <input value="{{$customer[0]->infReddit}}" type="text" class="form-control" id="inf_Reddit" name="inf_Reddit" >
                                </div>   
                            </div>

                            
                        </div>

                    </div>
                </div>
            </div>





            <div class="card shadow mb-4">
                <div class="card-header py-3"></div>
                <div class="card-body">
                    <div class="panel-body">   
                        <div class="row">
                            <div class="col-md-3">
                                <button id="inputSubmit" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
</div>
    

@stop

