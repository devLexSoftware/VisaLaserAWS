@extends('layouts.default')
@section('content')

@if($errors->any())
<!-- <h4>{{$errors->first()}}</h4> -->
<div class="container">    

<div class="row">
    <div class="col-md-12">
        <div class="form-group alert alert-danger" id="erroresTarjeta" >
                <!-- <span class="card-errors"></span> -->
                <label class="card-errors" >{{$errors->first()}}</label>                        
        </div> 
    </div> 

    </div> 
</div> 
@endif

<div id="exTab2" class="container">	
    <h4 style="text-align: center; font-size:30px;">Estatus de solicitud: {{$customer[0]->trStatus}}</h4>
    <hr>
    @if($customer[0]->trStatus == "Pago Pendiente")

    <div class="panel-body">    
        <form id="card-form" action="repeatPaymethod" method="post" enctype="multipart/form-data">    
        {{ csrf_field() }}

            <div class="row">
               

                <div class="col-md-12">
                <div class="form-group">
                    <div class="d-block my-3">
                      
                        <div class="custom-control custom-radio">
                            <input id="paymethod" name="paymethod" onclick="MetodoPago(this)" value="paypal" type="radio" class="custom-control-input" >
                            <!-- <label class="custom-control-label" style="margin-right: 100px;" for="paypal">PayPal</label>e -->
                            <img src="{{ asset('images/paypal.png') }}" style="margin-right: 100px;" border="0" alt="PayPal ">
                        
                            <input id="paymethod" name="paymethod" onclick="MetodoPago(this)" value="tarjeta" type="radio" class="custom-control-input">
                            <!-- <label class="custom-control-label" for="conekta">Tarjeta</label> -->
                            <img src="{{ asset('images/visamastercard.png') }}" style="margin-right: 100px; width:120px;" border="0" alt="PayPal ">

                            <input type="hidden" id="metodoPagoPreferente" name="metodoPagoPreferente" value="paypal">

                        </div>
                    </div>
                </div>
            </div>  
                <input value="{{$customer[0]->usId}}" required type="hidden" class="form-control" id="basic_usId" name="basic_usId" aria-describedby="" placeholder="Nombre(s)">
                <input value="{{$customer[0]->curId}}" required type="hidden" class="form-control" id="basic_cuId" name="basic_cuId" aria-describedby="" placeholder="Nombre(s)">
                <input value="{{$customer[0]->trId}}" required type="hidden" class="form-control" id="basic_trId" name="basic_trId" aria-describedby="" placeholder="Nombre(s)">
                <input value="{{$customer[0]->cuFirst}}" required  type="hidden" class="form-control" id="in_nombre" name="in_nombre" aria-describedby="" placeholder="Nombre(s)">
                <input value="{{$customer[0]->cuLast}}" required type="hidden" class="form-control" id="in_apellidos" name="in_apellidos" aria-describedby="" placeholder="Apellidos(s)">
                <input value="{{$customer[0]->usEmail}}" required type="hidden" class="form-control" id="in_email" name="in_email">
               
               
                <input type="hidden" id="in_movil" name="in_movil" value="{{$customer[0]->cuTelephone}}">

                <input type="hidden" id="costoTotal" name="costoTotal" value="0">
                


            </div>

            <hr>
            <div class="row">            
                <div class="col-md-12">
                    <div class="form-group">
                    <h3 id="costoVisa"></h3>
                    </div>            
                </div>
            </div>
            <hr>
            
            <div id="divTarjeta" style="display:none">               

                <div class="row" >            
                    <div class="col-md-6">                    
                        <div class="form-group">                    
                            <label>Nombre completo que aparece en la tarjeta</label>
                            <input pattern="[a-zA-Z ]{2,254}" title="No se aceptan números" class="form-control" id="nomTarjeta" type="text" maxlength="40" data-conekta="card[name]">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label>Número de tarjeta de crédito o debito</label>                        
                            <input class="form-control" id="numTarjeta" type="number" size="20" data-conekta="card[number]">                        
                        </div>                    
                    </div>
                </div>      

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label><span class="hidden-xs">Fecha expiración</span> </label>
                            <div class="form-inline">
                                <select class="form-control"  style="width:45%" id="mmTarjeta" data-conekta="card[exp_month]">
                                    <option selected>MM</option>
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                                <span style="width:10%; text-align: center"> / </span>
                                <select class="form-control" style="width:45%"  id="yyTarjeta" data-conekta="card[exp_year]">
                                    <option selected>YY</option>
                                    <option value="20">2020</option>
                                    <option value="21">2021</option>
                                    <option value="22">2022</option>
                                    <option value="23">2023</option>
                                    <option value="24">2024</option>
                                    <option value="25">2025</option>
                                    <option value="26">2026</option>
                                    <option value="27">2027</option>
                                    <option value="28">2028</option>
                                    <option value="29">2029</option>
                                    <option value="30">2030</option>
                                    <option value="31">2031</option>
                                    <option value="32">2032</option>
                                    <option value="33">2033</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                            <input class="form-control" required id="cvcTarjeta" type="number" size="4" data-conekta="card[cvc]">
                        </div> <!-- form-group.// -->
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group alert alert-danger" id="erroresTarjeta" style="display:none">
                            <!-- <span class="card-errors"></span> -->
                            <label class="card-errors" ></label>                        
                        </div> 
                    </div> 
                </div>

            </div> 


            <button  type="submit" id="inputSubmit" class="btn btn-primary">Siguiente</button>
        </form>   
    </div>        

    <hr>
    @endif
    
    <br>

    <ul class="nav nav-tabs">
        <li class="active"><a  href="#1" data-toggle="tab">Información básica</a></li>
        <li><a href="#2" data-toggle="tab">Familiar</a></li>
        <li><a href="#3" data-toggle="tab">Educación y Laboral</a></li>
    </ul>
    
    <div class="tab-content ">

    
        <div class="tab-pane active" id="1">            
            <form id="firtsRegister" action="saveBasica" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-primary"> 
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Información</h3> 
                    </div> 
                    <div class="panel-body">    

                                                                                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                                    <input pattern="[a-zA-Z]+" title="No se aceptan números" value="{{$customer[0]->cuFirst}}" required  type="text" class="form-control" id="basic_nombre" name="basic_nombre" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->curId}}" required type="hidden" class="form-control" id="basic_cuId" name="basic_cuId" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->prId}}" required type="hidden" class="form-control" id="basic_prId" name="basic_prId" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->usId}}" required type="hidden" class="form-control" id="basic_usId" name="basic_usId" aria-describedby="" placeholder="Nombre(s)">
                                </div>
                            </div>                                  
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="sel1">Apellidos(s)<span class="star"> *</span></label>
                                    <input pattern="[a-zA-Z]+" title="No se aceptan números" value="{{$customer[0]->cuLast}}" required type="text" class="form-control" id="basic_apellidos" name="basic_apellidos" aria-describedby="" placeholder="Apellidos(s)">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1">Dirección<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->cuAddress}}" required  type="text" class="form-control" id="basic_address" name="basic_address" aria-describedby="emailHelp" placeholder="Dirección">
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

                            

                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Telefono<span class="star">*</span></label>
                                    <input pattern="[1-9]{1}[0-9]{9}" title="Ingresa 10 dígitos" value="{{$customer[0]->cuTelephone}}" required required type="text" class="form-control" id="basic_phone" name="basic_phone" aria-describedby="emailHelp" placeholder="Telefono">
                                </div>
                            </div>                                                               
                        </div>
                        
                    </div>
                </div>

                <div id="divErrores1" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias1" style="color:red; font-size: 12px;" for=""></label>
                </div>    

                <button id="inputSubmit1" type="submit" class="btn btn-success">Guardar</button>        
            </form>
        </div>
    
        <div class="tab-pane" id="2">
            <form id="firtsRegister" action="saveFamiliar" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-primary"> 
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Información</h3> 
                    </div> 
                    <div class="panel-body">    
                        <h4>Esposo(a)</h4>             
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
                            
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha de divorcio</label>
                                    <input value="{{$customer[0]->spDivorcied}}" type="date" class="form-control" id="married_dateDivorced" name="married_dateDivorced" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Fecha de matrimonio</label>
                                    <input value="{{$customer[0]->spMarryDate}}" type="date" class="form-control" id="married_dateMarriend" name="married_dateMarriend" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>    
                        </div>

                        <hr>
                        <br>
                        <h4>Contactos</h4>             
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coName}}" required type="text" class="form-control" id="contact_nombre" name="contact_nombre" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->coId}}"  type="hidden" class="form-control" id="contact_coId" name="contact_coId" aria-describedby="" placeholder="Nombre(s)">
                                </div>
                            </div>                                  
                            
                        </div>     

                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Relación</label> <span class="star"> *</span></label>
                                    <input value="{{$customer[0]->coRelationship}}" required type="text" class="form-control" id="contact_relation" name="contact_relation" aria-describedby="emailHelp" placeholder="Relación">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Telefono</label>
                                    <input value="{{$customer[0]->coTelephone}}" type="text" class="form-control" id="contact_phone" name="contact_phone" aria-describedby="emailHelp" placeholder="Telefono">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">Ciudad donde vive</label>
                                    <input value="{{$customer[0]->coCity}}" type="text" class="form-control" id="contact_living" name="contact_living" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>                                
                        </div>


                        <hr>
                        <br>
                        <h4>Padres</h4>             
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">Nombre de la madre<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->paNameMother}}" required type="text" class="form-control" id="parent_nameMother" name="parent_nameMother" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->paId}}"  type="hidden" class="form-control" id="parent_paId" name="parent_paId" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                  
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Estado migratorio</label>
                                    <input value="{{$customer[0]->paStatusMigratoryMother}}" type="text" class="form-control" id="parent_motherStatus" name="parent_motherStatus" aria-describedby="" placeholder="Estado">
                                </div>                
                            </div>       
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Estado migratorio</label>
                                    <input value="{{$customer[0]->paStatusMigratoryFather}}" type="text" class="form-control" id="parent_fatherStatus" name="parent_fatherStatus" aria-describedby="" placeholder="Estado">
                                </div>                
                            </div>       
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Fecha de nacimiento</label>
                                    <input value="{{$customer[0]->paBirthdayFather}}" type="date" class="form-control" id="parent_fatherBirthday" name="parent_fatherBirthday" aria-describedby="" placeholder="Fecha">
                                </div>                
                            </div>                                  
                        </div>     


                        

                    </div>
                </div>

                <div id="divErrores2" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias2" style="color:red; font-size: 12px;" for=""></label>
                </div>              
                <button   id="inputSubmit2" type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>

        <div class="tab-pane" id="3">
        <form id="firtsRegister" action="saveEducacion" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-primary"> 
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Información</h3> 
                    </div> 
                    <div class="panel-body">    

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
                                            <option value="Media superior">Media superior</option>
                                            <option value="Superior">Superior</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="education_grade" required name="education_grade" value="{{$customer[0]->edLevel}}">
                                            <option style="display:none;">Default</option>
                                            <option value="Primaria">Primaria</option>
                                            <option value="Secundaria">Secundaria</option>
                                            <option value="Media superior">Media superior</option>
                                            <option value="Superior">Superior</option>
                                        </select>  
                                        @endif
                                </div>
                            </div> 
                                                             
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Fecha de ingreso</label>
                                    <input value="{{$customer[0]->edAdmission}}" type="date" class="form-control" id="education_ingress" name="education_ingress" aria-describedby="" placeholder="Fecha">
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
                                <label for="sel1">Ciudad donde se encuentra el instituto</label>
                                    <input value="{{$customer[0]->edCity}}" type="text" class="form-control" id="education_city" name="education_city" aria-describedby="" placeholder="Ciudad">
                                </div>                
                            </div>                                                              
                        </div>


                        <hr>
                        <br>
                        <h4>Trabajo</h4>             
                        <br>             
                        
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
                                    <label for="sel1">Salario</label>
                                    <input value="{{$customer[0]->joSalary}}" type="text" class="form-control" id="job_salary" name="job_salary" aria-describedby="" placeholder="Salario">
                                </div>
                            </div> 
                                                             
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="sel1">Carrera</label>
                                    <input value="{{$customer[0]->joCarrer}}" type="text" class="form-control" id="job_carrer" name="job_carrer" aria-describedby="" placeholder="Carrera">
                                </div>                
                            </div>                                                              
                        </div>



                    </div>
                </div>

                <div id="divErrores3" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias3" style="color:red; font-size: 12px;" for=""></label>
                </div>              

                <button  id="inputSubmit3" type="submit" class="btn btn-success">Guardar</button>
                </form>
        </div>
    </div>
    
</div>



<div class="modal fade" id="loading">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Procesando Pago</h4>
            </div>
            <div class="modal-body">
                <div class="loader" class="center">Loading...</div>
            </div>            
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    

    
<script>


function costoVisa()
{    

    debugger;
    var edad = document.getElementById("in_year").value;       

    // var pay = document.getElementById("paymethod").value;   

    var pay = document.querySelector('input[name="paymethod"]:checked').value;


    if(edad <21 && pay == "paypal")        
        document.getElementById("costoVisa").innerHTML = "SERA CARGADO A SU CUENTA DE PAY PAL EL SIGUIENTE MONTO $35 USD" ;    
    else if(edad >=21 && pay == "paypal")    
        document.getElementById("costoVisa").innerHTML = "SERA CARGADO A SU CUENTA DE PAY PAL EL SIGUIENTE MONTO $55 USD" ;
    else if(edad <21 && pay == "tarjeta")    
        document.getElementById("costoVisa").innerHTML = "SERA CARGADO A SU TARJETA EL SIGUIENTE MONTO $35 USD" ;    
    else if(edad >=21 && pay == "tarjeta")    
        document.getElementById("costoVisa").innerHTML = "SERA CARGADO A SU TARJETA EL SIGUIENTE MONTO $55 USD" ;    

    if(edad < 21)
    {
        document.getElementById("costoTotal").value="35"        
    }
    else
    {
        document.getElementById("costoTotal").value="55"        
    }

}

    function MetodoPago(obj){
        

        if(obj.value == "paypal"){
            // document.getElementById("inputSubmit").disabled = true;        

            document.getElementById("nomTarjeta").value = "";
            document.getElementById("nomTarjeta").required = false;
            document.getElementById("numTarjeta").value = "";
            document.getElementById("numTarjeta").required = false;
            document.getElementById("cvcTarjeta").value = "";
            document.getElementById("cvcTarjeta").required = false;
            document.getElementById("mmTarjeta").value = "";
            document.getElementById("mmTarjeta").required = false;
            document.getElementById("yyTarjeta").value = "";
            document.getElementById("yyTarjeta").required = false;

            document.getElementById("divTarjeta").style.display = "none";
            document.getElementById("metodoPagoPreferente").value = "paypal";            
            


        }
        else{
            document.getElementById("nomTarjeta").required = true;
            document.getElementById("numTarjeta").required = true;
            document.getElementById("cvcTarjeta").required = true;
            document.getElementById("mmTarjeta").required = true;
            document.getElementById("yyTarjeta").required = true;

            document.getElementById("divTarjeta").style.display = "block";
            document.getElementById("metodoPagoPreferente").value = "tarjeta";
            

            
        }
        costoVisa();

    }

    function checkPassword(){
        debugger

        var p1 =document.getElementById("basic_password1").value;
        var p2 =document.getElementById("basic_password2").value;

        var pay = document.querySelector('input[name="paymethod"]:checked');


        if(p1 != p2){
            document.getElementById("divErrores1").style.display = "block";
            document.getElementById("inputSubmit1").disabled = true;
            document.getElementById("labelAdvertencias1").innerText = "Las contraseñas no concuerdan";

            if(pay == null) 
                document.getElementById("inputSubmit").disabled = true;
        }
        else{
            document.getElementById("divErrores1").style.display = "none";
            document.getElementById("inputSubmit1").disabled = false;
            document.getElementById("labelAdvertencias1").innerText = "";
            
            if(pay == null)
                document.getElementById("inputSubmit").disabled = true;
        }
    }
</script>


@stop