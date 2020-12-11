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

<div  class="container">	
<h5 style="text-align: center; font-size:18px;">Toda la información de este formulario no será enviada al departamento de visas hasta que haya sido validada y aprobada por usted.</h5>
</div>

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
        <li><a href="#4" data-toggle="tab">VISA/Passaporte</a></li>
        <li><a href="#5" data-toggle="tab">Viaje Planeado</a></li>
        <li><a href="#6" data-toggle="tab">Información Adicional</a></li>
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

                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1">Dirección<span class="star"> *</span></label>
                                    <input value="{{$customer[0]->cuAddress}}" required  type="text" class="form-control" id="basic_address" name="basic_address" aria-describedby="emailHelp" placeholder="Dirección">
                                </div>
                            </div>                                                                                                          
                        </div>     -->

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

                <div id="divErrores1" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias1" style="color:red; font-size: 12px;" for=""></label>
                </div>    


                <h5>Este formulario es un borrador si hay datos que usted no sepa con precisión nuestro personal le ayudará a resolver todas sus dudas</h5>
                <button id="inputSubmit1" type="submit" class="btn btn-success">Guardar y Continuar</button>        
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
                                <div style="display:none; diabled:true;" class="form-group" id="married_nombreLabel" name="married_nombreLabel">
                                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->spName}}"   type="text" class="form-control" id="married_nombre" name="married_nombre" aria-describedby="" placeholder="Nombre(s)">
                                    <input value="{{$customer[0]->spId}}"   type="hidden" class="form-control" id="married_spId" name="married_spId" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                                              
                        </div>                        

                        <div class="row">
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="married_birthdayLabel" name="married_birthdayLabel">
                                    <label for="sel1">Fecha nacimiento</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->spBirthday}}" type="date" class="form-control" id="married_birthday" name="married_birthday" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="married_placeLabel" name="married_placeLabel">
                                    <label for="sel1">Lugar de nacimiento</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->spBirthdayPlace}}" type="text" class="form-control" id="married_place" name="married_place" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>    

                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="married_livingLabel" name="married_livingLabel">
                                    <label for="sel1">Lugar donde vive</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->spLiving}}" type="text" class="form-control" id="married_living" name="married_living" aria-describedby="emailHelp" placeholder="Ciudad">
                                </div>
                            </div>    
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="married_dateMarriendLabel" name="married_dateMarriendLabel">
                                    <label for="sel1">Fecha de matrimonio</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->spMarryDate}}" type="date" class="form-control" id="married_dateMarriend" name="married_dateMarriend" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>   
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div style="display:none; diabled:true;" class="form-group" id="married_adressLabel" name="married_adressLabel">
                                    <label for="sel1">Domicilio del Cónyuge o Pareja.</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->spAdress}}" type="text" class="form-control" id="married_adress" name="married_adress" aria-describedby="emailHelp" placeholder="Dirección">
                                </div>
                            </div>   

                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="married_dateDivorcedLabel" name="married_dateDivorcedLabel">
                                    <label for="sel1">Fecha de divorcio (Si Aplica)</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->spDivorcied}}" type="date" class="form-control" id="married_dateDivorced" name="married_dateDivorced" aria-describedby="emailHelp" placeholder="Fecha">
                                </div>
                            </div>                               
                        </div>

                        <hr>
                        <br>
                        <h4>Contactos</h4>                  
                        <p>Si cuenta con contactos en Estados Unidos ingrese la información solicitada</p>                   
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

                <div id="divErrores2" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias2" style="color:red; font-size: 12px;" for=""></label>
                </div>              

                <h5>Este formulario es un borrador si hay datos que usted no sepa con precisión nuestro personal le ayudará a resolver todas sus dudas</h5>
                <button   id="inputSubmit2" type="submit" class="btn btn-success">Guardar y Continuar</button>
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sel1">Ocupación o actividad del solicitante</label>
                                    <input value="{{$customer[0]->proOcupation}}" type="text" class="form-control" id="pro_ocupation" name="pro_ocupation" aria-describedby="" placeholder="Ocupación">                                    
                                    <input value="{{$customer[0]->prId}}"  type="hidden" class="form-control" id="pro_Id" name="pro_Id" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                                                                                                                                   
                        </div>


                        <h4>Trabajo (Si actualmente no cuenta con trabajo, pase a la siguiente sección)</h4>                                     
                        
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
                                    <small class="form-text text-muted" style="color: #3e88bd">En esta cantidad, deberá de incluir los ingresos extras y no declarados</small>

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
                                    @if($customer[0]->hijoHistory != "")                                    
                                        <select class="form-control" id="hijo_History" name="hijo_History"   onchange="openOption('historyJob')">
                                            <option value="{{$customer[0]->hijoHistory}}" selected><?php echo $customer[0]->hijoHistory; ?></option>                                    
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="hijo_History" name="hijo_History" onchange="openOption('historyJob')">
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
                                <div  style="display:none; diabled:true;" class="form-group" id="hijo_NameLabel" name="hijo_NameLabel">
                                    <label for="sel1">Nombre de la empresa anterior</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->hijoName}}" type="text" class="form-control" id="hijo_Name" name="hijo_Name" placeholder="Nombre">
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div style="display:none; diabled:true;" class="form-group"  id="hijo_DireccionLabel" name="hijo_DireccionLabel">
                                    <label for="sel1">Dirección de la empresa anterior</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->hijoDireccion}}" type="text" class="form-control" id="hijo_Direccion" name="hijo_Direccion" placeholder="Dirección">
                                </div>
                            </div> 
                        </div> 

                        <div class="row">
                            <div class="col-md-6">
                                <div style="display:none; diabled:true;" class="form-group"  id="hijo_BossLabel" name="hijo_BossLabel">
                                    <label for="sel1">Nombre de tu jefe inmediato</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->hijoBoss}}" type="text" class="form-control" id="hijo_Boss" name="hijo_Boss" placeholder="Nombre">
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="hijo_PhoneLabel" name="hijo_PhoneLabel">
                                    <label for="sel1">Número telefónico</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->hijoPhone}}" type="number" class="form-control" id="hijo_Phone" name="hijo_Phone" placeholder="Telefóno">
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="hijo_DateLabel" name="hijo_DateLabel">
                                    <label for="sel1">Fecha en la que inicio</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->hijoDate}}" type="date" class="form-control" id="hijo_Date" name="hijo_Date" placeholder="Telefóno">
                                </div>
                            </div> 
                        </div> 

                        <div class="row">
                            <div class="col-md-12">
                                <div style="display:none; diabled:true;" class="form-group" id="hijo_NoteLabel" name="hijo_NoteLabel">
                                    <label for="sel1">Describa brevemente su actividad en este empleo.</label>
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->hijoNote}}" type="text" class="form-control" id="hijo_Note" name="hijo_Note" placeholder="Actividades">
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

                <div id="divErrores3" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias3" style="color:red; font-size: 12px;" for=""></label>
                </div>              

                <h5>Este formulario es un borrador si hay datos que usted no sepa con precisión nuestro personal le ayudará a resolver todas sus dudas</h5>
                <button  id="inputSubmit3" type="submit" class="btn btn-success">Guardar y Continuar</button>
                </form>
        </div>

        <div class="tab-pane" id="4">            
            <form id="firtsRegister" action="saveVisaPasaporte" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-primary"> 
                    <div class="panel-heading"> 
                        <h3 class="panel-title">VISA/Passaporte</h3> 
                    </div> 
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
                        <br>
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
                                            <select class="form-control" id="pr_VisaRobada" required name="pr_VisaRobada" value="Si" onchange="openOption('VisaRobadaExtraviada')">                                                
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
                                <div  style="display:none; diabled:true;" class="form-group" id="prv_VisaLostDateLabel" name="prv_VisaLostDateLabel">
                                    <label for="sel1">Fecha aproximada en que sucedió.</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->prvVisaLostDate}}"  type="date" class="form-control" id="prv_VisaLostDate" name="prv_VisaLostDate" placeholder="Fecha">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-6">
                                <div  style="display:none; diabled:true;" class="form-group" id="prv_VisaLostDescriptionLabel" name="prv_VisaLostDescriptionLabel">
                                    <label for="sel1">Descripción breve del Incidente.</label>                                
                                    <textarea  style="display:none; diabled:true;" value="{{$customer[0]->prvVisaLostDesc}}" class="form-control" id="prv_VisaLostDescription" name="prv_VisaLostDescription" placeholder="Descripción">{{$customer[0]->prvVisaLostDesc}}</textarea>
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
                                <div style="display:none; diabled:true;" class="form-group" id="prv_DeporteeDateLabel" name="prv_DeporteeDateLabel">
                                    <label for="sel1">Fecha en que sucedió.</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->prvDeporteeDate}}"  type="date" class="form-control" id="prv_DeporteeDate" name="prv_DeporteeDate" placeholder="Fecha">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-6">
                                <div style="display:none; diabled:true;" class="form-group" id="prv_DeporteeDescLabel" name="prv_DeporteeDescLabel">
                                    <label for="sel1">Descripción breve del Incidente</label>                                
                                    <textarea style="display:none; diabled:true;" value="{{$customer[0]->prvDeporteeDesc}}" class="form-control" id="prv_DeporteeDesc" name="prv_DeporteeDesc" placeholder="Descripción">{{$customer[0]->prvDeporteeDesc}}</textarea>                                    
                                </div>                
                            </div>                                  
                        </div>




                        
                        
                    </div>
                </div>

                <div id="divErrores1" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias1" style="color:red; font-size: 12px;" for=""></label>
                </div>    
                <h5>Este formulario es un borrador si hay datos que usted no sepa con precisión nuestro personal le ayudará a resolver todas sus dudas</h5>

                <button id="inputSubmit1" type="submit" class="btn btn-success">Guardar y Continuar</button>        
            </form>
        </div>

        <div class="tab-pane" id="5">            
            <form id="firtsRegister" action="saveTravelHistory" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-primary"> 
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Viaje Planeado</h3> 
                    </div> 
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
                                        <select class="form-control" id="tra_Planing" name="tra_Planing"  onchange="openOption('travelPlaning')">
                                            <option value="{{$customer[0]->traArreglo}}" selected>{{$customer[0]->traArreglo}}</option>
                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="tra_Planing" name="tra_Planing"  onchange="openOption('travelPlaning')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>    
                            <div class="col-md-3">
                                <div class="form-group" style="display:none; diabled:true;" id="tra_PlaningLabel" name="tra_PlaningLabel">
                                    <label for="sel1">¿Tipo de transporte?<span class="star"> *</span></label>                                
                                    @if($customer[0]->traPlanning != "")                                    
                                        <select class="form-control" id="typePlaning"  name="typePlaning"  value="{{$customer[0]->traPlanning}}">
                                        <option value="{{$customer[0]->traPlanning}}" selected>{{$customer[0]->traPlanning}}</option>                                                                                                                                                                                                                          
                                            <option value="Embarcación">Embarcación</option>                                            
                                            <option value="Línea Aérea">Línea Aérea</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="typePlaning"  name="typePlaning" >
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Embarcación">Embarcación</option>                                            
                                            <option value="Línea Aérea">Línea Aérea</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>     
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_DateReservationLabel" name="tra_DateReservationLabel">
                                    <label for="sel1">Fecha de Reservación.</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traDateReservation}}"  type="date" class="form-control" id="tra_DateReservation" name="tra_DateReservation" placeholder="Fecha">                                    
                                </div>                
                            </div>                    
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_NumReservationLabel" name="tra_NumReservationLabel">
                                    <label >Número de Reservación.</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traNumReservation}}" type="number" class="form-control" id="tra_NumReservation" name="tra_NumReservation" placeholder="Número">
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
                                        <select class="form-control" id="tra_Visit" name="tra_Visit" onchange="openOption('travelVisit')">
                                        <option value="{{$customer[0]->traVisitContactQues}}" selected>{{$customer[0]->traVisitContactQues}}</option>
                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="tra_Visit" onchange="openOption('travelVisit')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>      
                            <div class="col-md-6">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_CitiesLabel" name="tra_CitiesLabel">
                                    <label for="sel1">Ciudades que visitara.</label>                                
                                    <textarea style="display:none; diabled:true;" value="{{$customer[0]->traVisitCities}}" class="form-control" id="tra_Cities" name="tra_Cities" >{{$customer[0]->traVisitCities}}</textarea>
                                </div>                
                            </div>    
                        </div>
                        <label style="display:none; diabled:true;" id="tra_ContactLabel" name="tra_ContactLabel">Información sobre el contacto de E.U.</label>       
                        <div class="row">                                                                                                       
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_AdressContactLabel" name="tra_AdressContactLabel">
                                    <label for="sel1">Dirección </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traAdressContact}}" type="text" class="form-control" id="tra_AdressContact" name="tra_AdressContact" placeholder="Dirección">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_NameContactLabel" name="tra_NameContactLabel">
                                    <label for="sel1">Nombre </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traNameContact}}" type="text" class="form-control" id="tra_NameContact" name="tra_NameContact" placeholder="Nombre">
                                </div>                
                            </div>
                            <div class="col-md-2">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_RelationContactLabel" name="tra_RelationContactLabel">
                                    <label for="sel1">Relación </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traRelationContact}}" type="text" class="form-control" id="tra_RelationContact" name="tra_RelationContact" placeholder="Relación">
                                </div>                
                            </div>
                            <div class="col-md-2">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_PhoneContactLabel" name="tra_PhoneContactLabel">
                                    <label for="sel1">Móvil </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traPhoneContact}}" type="number" class="form-control" id="tra_PhoneContact" name="tra_PhoneContact" placeholder="Telefono">
                                </div>                
                            </div>
                            <div class="col-md-2">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_SituationContactLabel" name="tra_SituationContactLabel">
                                    <label for="sel1">Situación migratoria</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traSituationContact}}" type="text" class="form-control" id="tra_SituationContact" name="tra_SituationContact" placeholder="Situación">
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
                                        <select class="form-control" id="tra_Pay"  name="tra_Pay" onchange="openOption('travelPay')">
                                        <option value="{{$customer[0]->traPaymeQues}}" selected>{{$customer[0]->traPaymeQues}}</option>                                            
                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="tra_Pay"  name="tra_Pay" onchange="openOption('travelPay')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>                
                            </div>      
                        </div>      
                       
                        <label style="display:none; diabled:true;" id="tra_PayLabel" name="tra_PayLabel">Información sobre la persona que financiara su viaje de E.U.</label>       
                        <div class="row">                                                                                                                                   
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_PayAdressLabel" name="tra_PayAdressLabel">
                                    <label for="sel1">Dirección </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traPayAdress}}" type="text" class="form-control" id="tra_PayAdress" name="tra_PayAdress" placeholder="Dirección">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_PayNameLabel" name="tra_PayNameLabel">
                                    <label for="sel1">Nombre </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traPayName}}" type="text" class="form-control" id="tra_PayName" name="tra_PayName" placeholder="Nombre">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_PayRelationLabel" name="tra_PayRelationLabel">
                                    <label for="sel1">Relación </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traPayRelation}}" type="text" class="form-control" id="tra_PayRelation" name="tra_PayRelation" placeholder="Relación">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_PayPhoneLabel" name="tra_PayPhoneLabel">
                                    <label for="sel1">Número Telefónico </label>                                                           
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traPayPhone}}" type="number" class="form-control" id="tra_PayPhone" name="tra_PayPhone" placeholder="Telefono">
                                </div>                
                            </div>                                    
                        </div>

                        
                        <div class="row">    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Viaja usted acompañado?</label>                                
                                    @if($customer[0]->traFriendQues != "")                                    
                                        <select class="form-control" id="tra_Companion" name="tra_Companion" onchange="openOption('travelCompanion')">
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
                                <div style="display:none; diabled:true;" class="form-group" id="tra_CompanionNameLabel" name="tra_CompanionNameLabel">
                                    <label for="sel1">Nombre del acompañante </label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traCompanionName}}" type="text" class="form-control" id="tra_CompanionName" name="tra_CompanionName" placeholder="Nombre">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="tra_CompanionRelationLabel" name="tra_CompanionRelationLabel">
                                    <label for="sel1">Relación del acompañante</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->traCompanionRelation}}" type="text" class="form-control" id="tra_CompanionRelation" name="tra_CompanionRelation" placeholder="Relación">
                                </div>                
                            </div>  
                        </div>    

                        <hr>

                        <div class="row">    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Anteriormente has estado en E.U.?</label>                                
                                    @if($customer[0]->bacVisitEU != "")                                    
                                        <select class="form-control" id="back_history" name="back_history" onchange="openOption('back')">
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
                                <div class="form-group" style="display:none; diabled:true;" id="bac_LegalLabel" name="bac_LegalLabel">
                                    <label for="sel1">Ingresaste de forma legal o ilegal</label>                                
                                    @if($customer[0]->bacLegal != "")                                    
                                        <select style="display:none; diabled:true;" class="form-control" id="bac_Legal"  value="{{$customer[0]->bacLegal}}">
                                            <option value="{{$customer[0]->bacLegal}}" selected>{{$customer[0]->bacLegal}}</option>                                                                                        
                                            <option value="Legal">Legal</option>                                            
                                            <option value="Ilegal">Ilegal</option>
                                        </select>                                                                             
                                    @else
                                        <select style="display:none; diabled:true;" class="form-control" id="bac_Legal">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Legal">Legal</option>                                            
                                            <option value="Ilegal">Ilegal</option>
                                        </select>  
                                    @endif     
                                </div>                                                      
                            </div>                                
                        </div>      

                        <label style="display:none; diabled:true;" id="bac_VisitHistory" name="bac_VisitHistory">Información sobre visitas anteriores a E.U.</label>       

                        <div class="row">                                                                                                                                   
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_TimeAprox1Label" name="bac_TimeAprox1Label">
                                    <label for="sel1">Duración del primer viaje</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacTimeAprox1}}" type="text" class="form-control" id="bac_TimeAprox1" name="bac_TimeAprox1" placeholder="Duración">
                                    <input value="{{$customer[0]->bacId}}"  type="hidden" class="form-control" id="bac_Id" name="bac_Id" aria-describedby="" placeholder="Nombre(s)">

                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_DateAprox1Label" name="bac_DateAprox1Label">
                                    <label for="sel1">Fecha del primer viaje</label>                                                                                            
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacDateAprox1}}" type="date" class="form-control" id="bac_DateAprox1" name="bac_DateAprox1" placeholder="Fecha">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_TimeAprox2Label" name="bac_TimeAprox2Label">
                                    <label for="sel1">Duración del segundo viaje</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacTimeAprox2}}" type="text" class="form-control" id="bac_TimeAprox2" name="bac_TimeAprox2" placeholder="Duración">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_DateAprox2Label" name="bac_DateAprox2Label">
                                    <label for="sel1">Fecha del segundo viaje</label>                                                                                                   
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacDateAprox2}}" type="date" class="form-control" id="bac_DateAprox2" name="bac_DateAprox2" placeholder="Fecha">
                                </div>                
                            </div>
                            
                            
                        </div>

                        <div class="row">                                                                                                                                   
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_TimeAprox3Label" name="bac_TimeAprox3Label">
                                    <label for="sel1">Duración del tercer viaje</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacTimeAprox3}}" type="text" class="form-control" id="bac_TimeAprox3" name="bac_TimeAprox3" placeholder="Duración">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_DateAprox3Label" name="bac_DateAprox3Label">
                                    <label for="sel1">Fecha del tercer viaje</label>                                                                                                     
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacDateAprox3}}" type="date" class="form-control" id="bac_DateAprox3" name="bac_DateAprox3" placeholder="Fecha">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_TimeAprox4Label" name="bac_TimeAprox4Label">
                                    <label for="sel1">Duración del cuarto viaje</label>                                
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacTimeAprox4}}" type="text" class="form-control" id="bac_TimeAprox4" name="bac_TimeAprox4" placeholder="Duración">
                                </div>                
                            </div>
                            <div class="col-md-3">
                                <div style="display:none; diabled:true;" class="form-group" id="bac_DateAprox4Label" name="bac_DateAprox4Label">
                                    <label for="sel1">Fecha del cuarto viaje</label>                                                                                          
                                    <input style="display:none; diabled:true;" value="{{$customer[0]->bacDateAprox4}}" type="date" class="form-control" id="bac_DateAprox4" name="bac_DateAprox4" placeholder="Fecha">
                                </div>                
                            </div>
                            
                            
                        </div>

                        
                        
                    </div>
                </div>

                <div id="divErrores1" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias1" style="color:red; font-size: 12px;" for=""></label>
                </div>    

                <h5>Este formulario es un borrador si hay datos que usted no sepa con precisión nuestro personal le ayudará a resolver todas sus dudas</h5>
                <button id="inputSubmit1" type="submit" class="btn btn-success">Guardar y Continuar</button>        
            </form>
        </div>


        <div class="tab-pane" id="6">            
            <form id="sixRegister" action="saveInfo" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-primary"> 
                    <div class="panel-heading"> 
                        <h3 class="panel-title">Información adicional</h3> 
                    </div> 
                    <div class="panel-body">    

                                                                                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">¿Qué países has visitado en los últimos 5 años?</label>
                                    <textarea value="{{$customer[0]->infCountries}}"  class="form-control" id="inf_Countries" name="inf_Countries" placeholder="Pais(es)"></textarea>
                                    <input value="{{$customer[0]->infId}}"  type="hidden" class="form-control" id="inf_Id" name="inf_Id" aria-describedby="" placeholder="Nombre(s)">

                                </div>
                            </div>                                                                                                                                          
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel1">¿Que idiomas domina?</label>
                                    <textarea value="{{$customer[0]->infIdiomas}}"  class="form-control" id="inf_Idiomas" name="inf_Idiomas" placeholder="Idioma(s)"></textarea>
                                </div>
                            </div>                                                                                                                                          
                        </div>

                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sel1">¿Tiene habilidades con el uso de armas?</label>                                
                                    @if($customer[0]->infWeapons != "")                                    
                                        <select class="form-control" id="infoWeapons"  name="infoWeapons"   onchange="openOption('weapons')">
                                            <option value="{{$customer[0]->infWeapons}}" selected>{{$customer[0]->infWeapons}}</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>                                                                             
                                    @else
                                        <select class="form-control" id="infoWeapons" name="infoWeapons"   onchange="openOption('weapons')">
                                            <option style="display:none;">Default</option>                                            
                                            <option value="Si">Si</option>                                            
                                            <option value="No">No</option>
                                        </select>  
                                        @endif     
                                </div>        
                            </div>        
                            <div class="col-md-3">                                              
                                <div style="display:none; diabled:true;" class="form-group" id="info_WeaponsInfoLabel" name="info_WeaponsInfoLabel">
                                        <label for="sel1">¿En donde recibió adiestramiento?</label>                                
                                        <input style="display:none; diabled:true;" value="{{$customer[0]->infWeaponsInfo}}" type="text" class="form-control" id="info_WeaponsInfo" name="info_WeaponsInfo" placeholder="">
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




                <div id="divErrores1" style="display: none">
                    <h5 style="color: red;">Errores</h6>
                    <label id="labelAdvertencias1" style="color:red; font-size: 12px;" for=""></label>
                </div>    

                <h5>Este formulario es un borrador si hay datos que usted no sepa con precisión nuestro personal le ayudará a resolver todas sus dudas</h5>
                <button id="inputSubmit1" type="submit" class="btn btn-success">Guardar y Continuar</button>        
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

<script>
function openOption(valor)
{
    switch (valor) {
        case 'conyugue':
            var p1 =document.getElementById("pr_Civil").value;
            if(p1 != "Soltero(Nunca casado)"){
                document.getElementById("married_nombre").style.display = "block";
                document.getElementById("married_nombre").disabled = false;     
                document.getElementById("married_nombre").value = "";                                      
                document.getElementById("married_nombreLabel").style.display = "block";                 

                document.getElementById("married_birthday").style.display = "block";
                document.getElementById("married_birthday").disabled = false;    
                document.getElementById("married_birthday").value = "";                                      
                document.getElementById("married_birthdayLabel").style.display = "block";  

                document.getElementById("married_place").style.display = "block";
                document.getElementById("married_place").disabled = false;    
                document.getElementById("married_place").value = "";                                      
                document.getElementById("married_placeLabel").style.display = "block";

                document.getElementById("married_living").style.display = "block";
                document.getElementById("married_living").disabled = false;    
                document.getElementById("married_living").value = "";                                      
                document.getElementById("married_livingLabel").style.display = "block";    

                document.getElementById("married_dateMarriend").style.display = "block";
                document.getElementById("married_dateMarriend").disabled = false;    
                document.getElementById("married_dateMarriend").value = "";                                      
                document.getElementById("married_dateMarriendLabel").style.display = "block";                  

                document.getElementById("married_adress").style.display = "block";
                document.getElementById("married_adress").disabled = false;    
                document.getElementById("married_adress").value = "";                                      
                document.getElementById("married_adressLabel").style.display = "block";                  

                document.getElementById("married_dateDivorced").style.display = "block";
                document.getElementById("married_dateDivorced").disabled = false;    
                document.getElementById("married_dateDivorced").value = "";                                      
                document.getElementById("married_dateDivorcedLabel").style.display = "block";                  
            }
            else{
                document.getElementById("married_nombre").style.display = "none";
                document.getElementById("married_nombre").disabled = true;     
                document.getElementById("married_nombre").value = "";                                      
                document.getElementById("married_nombreLabel").style.display = "none";                 

                document.getElementById("married_birthday").style.display = "none";
                document.getElementById("married_birthday").disabled = true;    
                document.getElementById("married_birthday").value = "";                                      
                document.getElementById("married_birthdayLabel").style.display = "none";  

                document.getElementById("married_place").style.display = "none";
                document.getElementById("married_place").disabled = true;    
                document.getElementById("married_place").value = "";                                      
                document.getElementById("married_placeLabel").style.display = "none";

                document.getElementById("married_living").style.display = "none";
                document.getElementById("married_living").disabled = true;    
                document.getElementById("married_living").value = "";                                      
                document.getElementById("married_livingLabel").style.display = "none";    

                document.getElementById("married_dateMarriend").style.display = "none";
                document.getElementById("married_dateMarriend").disabled = true;    
                document.getElementById("married_dateMarriend").value = "";                                      
                document.getElementById("married_dateMarriendLabel").style.display = "none";                  

                document.getElementById("married_adress").style.display = "none";
                document.getElementById("married_adress").disabled = true;    
                document.getElementById("married_adress").value = "";                                      
                document.getElementById("married_adressLabel").style.display = "none";                  

                document.getElementById("married_dateDivorced").style.display = "none";
                document.getElementById("married_dateDivorced").disabled = true;    
                document.getElementById("married_dateDivorced").value = "";                                      
                document.getElementById("married_dateDivorcedLabel").style.display = "none";                  

            }
            break;

        case 'VisaRobadaExtraviada':
            var p1 =document.getElementById("pr_VisaRobada").value;
            if(p1 == "Si"){
                document.getElementById("prv_VisaLostDate").style.display = "block";
                document.getElementById("prv_VisaLostDate").disabled = false;     
                document.getElementById("prv_VisaLostDate").value = "";                                      
                document.getElementById("prv_VisaLostDateLabel").style.display = "block";                 

                document.getElementById("prv_VisaLostDescription").style.display = "block";
                document.getElementById("prv_VisaLostDescription").disabled = false;    
                document.getElementById("prv_VisaLostDescription").value = "";                                      
                document.getElementById("prv_VisaLostDescriptionLabel").style.display = "block";                 
            }
            else{
                document.getElementById("prv_VisaLostDate").style.display = "none";
                document.getElementById("prv_VisaLostDate").disabled = true;    
                document.getElementById("prv_VisaLostDate").value = "";    
                document.getElementById("prv_VisaLostDateLabel").style.display = "none";  

                document.getElementById("prv_VisaLostDescription").style.display = "none";                
                document.getElementById("prv_VisaLostDescription").disabled = true;   
                document.getElementById("prv_VisaLostDescription").value = "";                                      
                document.getElementById("prv_VisaLostDescriptionLabel").style.display = "none";                 

            }
            break;

        case 'VisaNegadaDeportado':            
            var p1 =document.getElementById("pr_Deportee").value;
            if(p1 == "Si"){
                document.getElementById("prv_DeporteeDate").style.display = "block";
                document.getElementById("prv_DeporteeDate").disabled = false;     
                document.getElementById("prv_DeporteeDate").value = "";                                      

                document.getElementById("prv_DeporteeDateLabel").style.display = "block";                 
                document.getElementById("prv_DeporteeDesc").style.display = "block";
                document.getElementById("prv_DeporteeDesc").disabled = false;    
                document.getElementById("prv_DeporteeDesc").value = "";                                      
                document.getElementById("prv_DeporteeDescLabel").style.display = "block";                 
            }
            else{
                document.getElementById("prv_DeporteeDate").style.display = "none";
                document.getElementById("prv_DeporteeDate").disabled = true;    
                document.getElementById("prv_DeporteeDate").value = "";    
                document.getElementById("prv_DeporteeDateLabel").style.display = "none";                 
                document.getElementById("prv_DeporteeDesc").style.display = "none";                
                document.getElementById("prv_DeporteeDesc").disabled = true;   
                document.getElementById("prv_DeporteeDesc").value = "";                                      
                document.getElementById("prv_DeporteeDescLabel").style.display = "none";                 

            }
            break;    

        case 'travelPlaning':                    
            var p1 =document.getElementById("tra_Planing").value;
            if(p1 == "Si"){
                document.getElementById("tra_PlaningLabel").style.display = "block";                 

                document.getElementById("typePlaning").style.display = "block";
                document.getElementById("typePlaning").disabled = false;     
                document.getElementById("typePlaning").value = "";                        
                                

                document.getElementById("tra_DateReservationLabel").style.display = "block";                 
                document.getElementById("tra_DateReservation").style.display = "block";
                document.getElementById("tra_DateReservation").disabled = false;    
                document.getElementById("tra_DateReservation").value = "";                                                      

                document.getElementById("tra_NumReservationLabel").style.display = "block";                 
                document.getElementById("tra_NumReservation").style.display = "block";
                document.getElementById("tra_NumReservation").disabled = false;    
                document.getElementById("tra_NumReservation").value = "";                                                      
            }
            else{

                document.getElementById("typePlaning").style.display = "none";
                document.getElementById("typePlaning").disabled = true;     
                document.getElementById("typePlaning").value = "";                        

                document.getElementById("tra_PlaningLabel").style.display = "none";                 
              
                document.getElementById("tra_DateReservationLabel").style.display = "none";                 
                document.getElementById("tra_DateReservation").style.display = "none";
                document.getElementById("tra_DateReservation").disabled = true;    
                document.getElementById("tra_DateReservation").value = "";                                                      

                document.getElementById("tra_NumReservationLabel").style.display = "none";                 
                document.getElementById("tra_NumReservation").style.display = "none";
                document.getElementById("tra_NumReservation").disabled = true;    
                document.getElementById("tra_NumReservation").value = "";                            

            }
            break;  

        case 'travelVisit':                    
            var p1 =document.getElementById("tra_Visit").value;
            if(p1 == "Si"){
                document.getElementById("tra_ContactLabel").style.display = "block";                                 

                document.getElementById("tra_CitiesLabel").style.display = "none";                 
                document.getElementById("tra_Cities").style.display = "none";
                document.getElementById("tra_Cities").disabled = true;    
                document.getElementById("tra_Cities").value = "";   

                document.getElementById("tra_AdressContactLabel").style.display = "block";                 
                document.getElementById("tra_AdressContact").style.display = "block";
                document.getElementById("tra_AdressContact").disabled = false;    
                document.getElementById("tra_AdressContact").value = "";                                                      

                document.getElementById("tra_NameContactLabel").style.display = "block";                 
                document.getElementById("tra_NameContact").style.display = "block";
                document.getElementById("tra_NameContact").disabled = false;    
                document.getElementById("tra_NameContact").value = "";

                document.getElementById("tra_RelationContactLabel").style.display = "block";                 
                document.getElementById("tra_RelationContact").style.display = "block";
                document.getElementById("tra_RelationContact").disabled = false;    
                document.getElementById("tra_RelationContact").value = "";   

                document.getElementById("tra_PhoneContactLabel").style.display = "block";                 
                document.getElementById("tra_PhoneContact").style.display = "block";
                document.getElementById("tra_PhoneContact").disabled = false;    
                document.getElementById("tra_PhoneContact").value = "";   

                document.getElementById("tra_SituationContactLabel").style.display = "block";                 
                document.getElementById("tra_SituationContact").style.display = "block";
                document.getElementById("tra_SituationContact").disabled = false;    
                document.getElementById("tra_SituationContact").value = "";                                                      
            }
            else{
                document.getElementById("tra_ContactLabel").style.display = "none";                 

                document.getElementById("tra_CitiesLabel").style.display = "block";                 
                document.getElementById("tra_Cities").style.display = "block";
                document.getElementById("tra_Cities").disabled = false;    
                document.getElementById("tra_Cities").value = "";                   
                
                document.getElementById("tra_ContactLabel").style.display = "none";                 
                document.getElementById("tra_AdressContactLabel").style.display = "none";                 
                document.getElementById("tra_AdressContact").style.display = "none";
                document.getElementById("tra_AdressContact").disabled = true;    
                document.getElementById("tra_AdressContact").value = "";                                                      

                document.getElementById("tra_NameContactLabel").style.display = "none";                 
                document.getElementById("tra_NameContact").style.display = "none";
                document.getElementById("tra_NameContact").disabled = true;    
                document.getElementById("tra_NameContact").value = "";

                document.getElementById("tra_RelationContactLabel").style.display = "none";                 
                document.getElementById("tra_RelationContact").style.display = "none";
                document.getElementById("tra_RelationContact").disabled = true;    
                document.getElementById("tra_RelationContact").value = "";                           

                document.getElementById("tra_PhoneContactLabel").style.display = "none";                 
                document.getElementById("tra_PhoneContact").style.display = "none";
                document.getElementById("tra_PhoneContact").disabled = true;    
                document.getElementById("tra_PhoneContact").value = "";    

                document.getElementById("tra_SituationContactLabel").style.display = "none";                 
                document.getElementById("tra_SituationContact").style.display = "none";
                document.getElementById("tra_SituationContact").disabled = true;    
                document.getElementById("tra_SituationContact").value = "";                           

            }
            break;  

        case 'travelPay':                    
            var p1 =document.getElementById("tra_Pay").value;
            if(p1 == "No"){
                document.getElementById("tra_PayLabel").style.display = "block";                 
                
                document.getElementById("tra_PayNameLabel").style.display = "block";                 
                document.getElementById("tra_PayName").style.display = "block";
                document.getElementById("tra_PayName").disabled = false;    
                document.getElementById("tra_PayName").value = "";                                                      

                document.getElementById("tra_PayAdressLabel").style.display = "block";                 
                document.getElementById("tra_PayAdress").style.display = "block";
                document.getElementById("tra_PayAdress").disabled = false;    
                document.getElementById("tra_PayAdress").value = "";

                document.getElementById("tra_PayRelationLabel").style.display = "block";                 
                document.getElementById("tra_PayRelation").style.display = "block";
                document.getElementById("tra_PayRelation").disabled = false;    
                document.getElementById("tra_PayRelation").value = "";   

                document.getElementById("tra_PayPhoneLabel").style.display = "block";                 
                document.getElementById("tra_PayPhone").style.display = "block";
                document.getElementById("tra_PayPhone").disabled = false;    
                document.getElementById("tra_PayPhone").value = "";   
                
            }
            else{

                document.getElementById("tra_PayLabel").style.display = "none";                 
                
                document.getElementById("tra_PayNameLabel").style.display = "none";                 
                document.getElementById("tra_PayName").style.display = "none";
                document.getElementById("tra_PayName").disabled = true;    
                document.getElementById("tra_PayName").value = "";                                                      

                document.getElementById("tra_PayAdressLabel").style.display = "none";                 
                document.getElementById("tra_PayAdress").style.display = "none";
                document.getElementById("tra_PayAdress").disabled = true;    
                document.getElementById("tra_PayAdress").value = "";

                document.getElementById("tra_PayRelationLabel").style.display = "none";                 
                document.getElementById("tra_PayRelation").style.display = "none";
                document.getElementById("tra_PayRelation").disabled = true;    
                document.getElementById("tra_PayRelation").value = "";   

                document.getElementById("tra_PayPhoneLabel").style.display = "none";                 
                document.getElementById("tra_PayPhone").style.display = "none";
                document.getElementById("tra_PayPhone").disabled = true;    
                document.getElementById("tra_PayPhone").value = "";                             

            }
            break;  

        case 'travelCompanion':                    
            var p1 =document.getElementById("tra_Companion").value;
            if(p1 == "Si"){                
                
                document.getElementById("tra_CompanionNameLabel").style.display = "block";                 
                document.getElementById("tra_CompanionName").style.display = "block";
                document.getElementById("tra_CompanionName").disabled = false;    
                document.getElementById("tra_CompanionName").value = "";                                                      

                document.getElementById("tra_CompanionRelationLabel").style.display = "block";                 
                document.getElementById("tra_CompanionRelation").style.display = "block";
                document.getElementById("tra_CompanionRelation").disabled = false;    
                document.getElementById("tra_CompanionRelation").value = "";                
                
            }
            else{                
                
                document.getElementById("tra_CompanionNameLabel").style.display = "none";                 
                document.getElementById("tra_CompanionName").style.display = "none";
                document.getElementById("tra_CompanionName").disabled = true;    
                document.getElementById("tra_CompanionName").value = "";                                                      

                document.getElementById("tra_CompanionRelationLabel").style.display = "none";                 
                document.getElementById("tra_CompanionRelation").style.display = "none";
                document.getElementById("tra_CompanionRelation").disabled = true;    
                document.getElementById("tra_CompanionRelation").value = "";                           

            }
            break;  

        case 'back':                    
            var p1 =document.getElementById("back_history").value;
            if(p1 == "Si"){                
                document.getElementById("bac_VisitHistory").style.display = "block";                 
                
                document.getElementById("bac_LegalLabel").style.display = "block";                 
                document.getElementById("bac_Legal").style.display = "block";
                document.getElementById("bac_Legal").disabled = false;    

                document.getElementById("bac_TimeAprox1Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox1").style.display = "block";
                document.getElementById("bac_TimeAprox1").disabled = false;    
                document.getElementById("bac_TimeAprox1").value = "";

                document.getElementById("bac_DateAprox1Label").style.display = "block";                 
                document.getElementById("bac_DateAprox1").style.display = "block";
                document.getElementById("bac_DateAprox1").disabled = false;    
                document.getElementById("bac_DateAprox1").value = "";

                document.getElementById("bac_TimeAprox2Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox2").style.display = "block";
                document.getElementById("bac_TimeAprox2").disabled = false;    
                document.getElementById("bac_TimeAprox2").value = "";

                document.getElementById("bac_DateAprox2Label").style.display = "block";                 
                document.getElementById("bac_DateAprox2").style.display = "block";
                document.getElementById("bac_DateAprox2").disabled = false;    
                document.getElementById("bac_DateAprox2").value = "";

                document.getElementById("bac_TimeAprox3Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox3").style.display = "block";
                document.getElementById("bac_TimeAprox3").disabled = false;    
                document.getElementById("bac_TimeAprox3").value = "";

                document.getElementById("bac_DateAprox3Label").style.display = "block";                 
                document.getElementById("bac_DateAprox3").style.display = "block";
                document.getElementById("bac_DateAprox3").disabled = false;    
                document.getElementById("bac_DateAprox3").value = "";

                document.getElementById("bac_TimeAprox4Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox4").style.display = "block";
                document.getElementById("bac_TimeAprox4").disabled = false;    
                document.getElementById("bac_TimeAprox4").value = "";

                document.getElementById("bac_DateAprox4Label").style.display = "block";                 
                document.getElementById("bac_DateAprox4").style.display = "block";
                document.getElementById("bac_DateAprox4").disabled = false;    
                document.getElementById("bac_DateAprox4").value = "";
                
            }
            else{                
                document.getElementById("bac_VisitHistory").style.display = "none";                 
                
                document.getElementById("bac_LegalLabel").style.display = "none";                 
                document.getElementById("bac_Legal").style.display = "none";
                document.getElementById("bac_Legal").disabled = true;                                       

                document.getElementById("bac_TimeAprox1Label").style.display = "none";                 
                document.getElementById("bac_TimeAprox1").style.display = "none";
                document.getElementById("bac_TimeAprox1").disabled = true;    
                document.getElementById("bac_TimeAprox1").value = "";

                document.getElementById("bac_DateAprox1Label").style.display = "none";                 
                document.getElementById("bac_DateAprox1").style.display = "none";
                document.getElementById("bac_DateAprox1").disabled = true;    
                document.getElementById("bac_DateAprox1").value = "";

                document.getElementById("bac_TimeAprox2Label").style.display = "none";                 
                document.getElementById("bac_TimeAprox2").style.display = "none";
                document.getElementById("bac_TimeAprox2").disabled = true;    
                document.getElementById("bac_TimeAprox2").value = "";

                document.getElementById("bac_DateAprox2Label").style.display = "none";                 
                document.getElementById("bac_DateAprox2").style.display = "none";
                document.getElementById("bac_DateAprox2").disabled = true;    
                document.getElementById("bac_DateAprox2").value = "";
                
                document.getElementById("bac_TimeAprox3Label").style.display = "none";                 
                document.getElementById("bac_TimeAprox3").style.display = "none";
                document.getElementById("bac_TimeAprox3").disabled = true;    
                document.getElementById("bac_TimeAprox3").value = "";

                document.getElementById("bac_DateAprox3Label").style.display = "none";                 
                document.getElementById("bac_DateAprox3").style.display = "none";
                document.getElementById("bac_DateAprox3").disabled = true;    
                document.getElementById("bac_DateAprox3").value = "";

                document.getElementById("bac_TimeAprox4Label").style.display = "none";                 
                document.getElementById("bac_TimeAprox4").style.display = "none";
                document.getElementById("bac_TimeAprox4").disabled = true;    
                document.getElementById("bac_TimeAprox4").value = "";

                document.getElementById("bac_DateAprox4Label").style.display = "none";                 
                document.getElementById("bac_DateAprox4").style.display = "none";
                document.getElementById("bac_DateAprox4").disabled = true;    
                document.getElementById("bac_DateAprox4").value = "";

            }
            break; 


        case 'historyJob':            
            var p1 =document.getElementById("hijo_History").value;            
            if(p1 == "No"){
                document.getElementById("hijo_NameLabel").style.display = "block";                 
                document.getElementById("hijo_Name").style.display = "block";
                document.getElementById("hijo_Name").disabled = false;    
                document.getElementById("hijo_Name").value = "";

                document.getElementById("hijo_DireccionLabel").style.display = "block";                 
                document.getElementById("hijo_Direccion").style.display = "block";
                document.getElementById("hijo_Direccion").disabled = false;    
                document.getElementById("hijo_Direccion").value = "";   

                document.getElementById("hijo_BossLabel").style.display = "block";                 
                document.getElementById("hijo_Boss").style.display = "block";
                document.getElementById("hijo_Boss").disabled = false;    
                document.getElementById("hijo_Boss").value = "";   

                document.getElementById("hijo_PhoneLabel").style.display = "block";                 
                document.getElementById("hijo_Phone").style.display = "block";
                document.getElementById("hijo_Phone").disabled = false;    
                document.getElementById("hijo_Phone").value = "";   

                document.getElementById("hijo_DateLabel").style.display = "block";                 
                document.getElementById("hijo_Date").style.display = "block";
                document.getElementById("hijo_Date").disabled = false;    
                document.getElementById("hijo_Date").value = "";                               

                document.getElementById("hijo_NoteLabel").style.display = "block";                 
                document.getElementById("hijo_Note").style.display = "block";
                document.getElementById("hijo_Note").disabled = false;    
                document.getElementById("hijo_Note").value = "";                               

            }
            else{
                document.getElementById("hijo_NameLabel").style.display = "none";                 
                document.getElementById("hijo_Name").style.display = "none";
                document.getElementById("hijo_Name").disabled = true;    
                document.getElementById("hijo_Name").value = "";

                document.getElementById("hijo_DireccionLabel").style.display = "none";                 
                document.getElementById("hijo_Direccion").style.display = "none";
                document.getElementById("hijo_Direccion").disabled = true;    
                document.getElementById("hijo_Direccion").value = "";   

                document.getElementById("hijo_BossLabel").style.display = "none";                 
                document.getElementById("hijo_Boss").style.display = "none";
                document.getElementById("hijo_Boss").disabled = true;    
                document.getElementById("hijo_Boss").value = "";   

                document.getElementById("hijo_PhoneLabel").style.display = "none";                 
                document.getElementById("hijo_Phone").style.display = "none";
                document.getElementById("hijo_Phone").disabled = true;    
                document.getElementById("hijo_Phone").value = "";   

                document.getElementById("hijo_DateLabel").style.display = "none";                 
                document.getElementById("hijo_Date").style.display = "none";
                document.getElementById("hijo_Date").disabled = true;    
                document.getElementById("hijo_Date").value = "";                               

                document.getElementById("hijo_NoteLabel").style.display = "none";                 
                document.getElementById("hijo_Note").style.display = "none";
                document.getElementById("hijo_Note").disabled = true;    
                document.getElementById("hijo_Note").value = "";                       

            }
            break;    
        
        case 'weapons':            
            var p1 =document.getElementById("infoWeapons").value;            
            if(p1 == "Si"){
                document.getElementById("info_WeaponsInfoLabel").style.display = "block";                 
                document.getElementById("info_WeaponsInfo").style.display = "block";
                document.getElementById("info_WeaponsInfo").disabled = false;    
                document.getElementById("info_WeaponsInfo").value = "";
                                        

            }
            else{
                document.getElementById("info_WeaponsInfoLabel").style.display = "none";                 
                document.getElementById("info_WeaponsInfo").style.display = "none";
                document.getElementById("info_WeaponsInfo").disabled = true;    
                document.getElementById("info_WeaponsInfo").value = "";                                  

            }
            break;    
        
        
        
        
        default:
            break;
    }
}
</script>

<script>
    $( document ).ready(function() {
        debugger;
        var p1 =document.getElementById("pr_Civil").value;
        
            if(p1 != "Soltero(Nunca casado)" && p1 != ""){
                document.getElementById("married_nombre").style.display = "block";
                document.getElementById("married_nombre").disabled = false;                     
                document.getElementById("married_nombreLabel").style.display = "block";                 

                document.getElementById("married_birthday").style.display = "block";
                document.getElementById("married_birthday").disabled = false;                    
                document.getElementById("married_birthdayLabel").style.display = "block";  

                document.getElementById("married_place").style.display = "block";
                document.getElementById("married_place").disabled = false;                                              
                document.getElementById("married_placeLabel").style.display = "block";

                document.getElementById("married_living").style.display = "block";
                document.getElementById("married_living").disabled = false;                                                 
                document.getElementById("married_livingLabel").style.display = "block";    

                document.getElementById("married_dateMarriend").style.display = "block";
                document.getElementById("married_dateMarriend").disabled = false;                                                      
                document.getElementById("married_dateMarriendLabel").style.display = "block";                  

                document.getElementById("married_adress").style.display = "block";
                document.getElementById("married_adress").disabled = false;                                          
                document.getElementById("married_adressLabel").style.display = "block";                  

                document.getElementById("married_dateDivorced").style.display = "block";
                document.getElementById("married_dateDivorced").disabled = false;                                                      
                document.getElementById("married_dateDivorcedLabel").style.display = "block";                  
            }


        var p1 =document.getElementById("pr_VisaRobada").value;
            if(p1 == "Si"){
                document.getElementById("prv_VisaLostDate").style.display = "block";
                document.getElementById("prv_VisaLostDate").disabled = false;                                                          
                document.getElementById("prv_VisaLostDateLabel").style.display = "block";                 

                document.getElementById("prv_VisaLostDescription").style.display = "block";
                document.getElementById("prv_VisaLostDescription").disabled = false;                                                      
                document.getElementById("prv_VisaLostDescriptionLabel").style.display = "block";                 
            }

            var p1 =document.getElementById("pr_Deportee").value;
            if(p1 == "Si"){
                document.getElementById("prv_DeporteeDate").style.display = "block";
                document.getElementById("prv_DeporteeDate").disabled = false;                                                 

                document.getElementById("prv_DeporteeDateLabel").style.display = "block";                 
                document.getElementById("prv_DeporteeDesc").style.display = "block";
                document.getElementById("prv_DeporteeDesc").disabled = false;                                               
                document.getElementById("prv_DeporteeDescLabel").style.display = "block";                 
            }

            var p1 =document.getElementById("tra_Planing").value;
            if(p1 == "Si"){                
                document.getElementById("tra_PlaningLabel").style.display = "block";                 

                document.getElementById("tra_DateReservationLabel").style.display = "block";                 
                document.getElementById("tra_DateReservation").style.display = "block";
                document.getElementById("tra_DateReservation").disabled = false;                                                                    

                document.getElementById("tra_NumReservationLabel").style.display = "block";                 
                document.getElementById("tra_NumReservation").style.display = "block";
                document.getElementById("tra_NumReservation").disabled = false;    
                                                           
            }

            var p1 =document.getElementById("tra_Visit").value;
            debugger;
            if(p1 == "Si"){
                document.getElementById("tra_ContactLabel").style.display = "block";                                 

                document.getElementById("tra_CitiesLabel").style.display = "none";                 
                document.getElementById("tra_Cities").style.display = "none";
                document.getElementById("tra_Cities").disabled = true;                    

                document.getElementById("tra_AdressContactLabel").style.display = "block";                 
                document.getElementById("tra_AdressContact").style.display = "block";
                document.getElementById("tra_AdressContact").disabled = false;                                                                  

                document.getElementById("tra_NameContactLabel").style.display = "block";                 
                document.getElementById("tra_NameContact").style.display = "block";
                document.getElementById("tra_NameContact").disabled = false;                    

                document.getElementById("tra_RelationContactLabel").style.display = "block";                 
                document.getElementById("tra_RelationContact").style.display = "block";
                document.getElementById("tra_RelationContact").disabled = false;                    

                document.getElementById("tra_PhoneContactLabel").style.display = "block";                 
                document.getElementById("tra_PhoneContact").style.display = "block";
                document.getElementById("tra_PhoneContact").disabled = false;                    

                document.getElementById("tra_SituationContactLabel").style.display = "block";                 
                document.getElementById("tra_SituationContact").style.display = "block";
                document.getElementById("tra_SituationContact").disabled = false;                    
            }
            else if(p1 == "No")
            {
                document.getElementById("tra_CitiesLabel").style.display = "block";                 
                document.getElementById("tra_Cities").style.display = "block";
                document.getElementById("tra_Cities").disabled = false;                                   
            }

            var p1 =document.getElementById("tra_Pay").value;
            if(p1 == "No"){
                document.getElementById("tra_PayLabel").style.display = "block";                 
                
                document.getElementById("tra_PayNameLabel").style.display = "block";                 
                document.getElementById("tra_PayName").style.display = "block";
                document.getElementById("tra_PayName").disabled = false;                                                                      

                document.getElementById("tra_PayAdressLabel").style.display = "block";                 
                document.getElementById("tra_PayAdress").style.display = "block";
                document.getElementById("tra_PayAdress").disabled = false;    

                document.getElementById("tra_PayRelationLabel").style.display = "block";                 
                document.getElementById("tra_PayRelation").style.display = "block";
                document.getElementById("tra_PayRelation").disabled = false;                    

                document.getElementById("tra_PayPhoneLabel").style.display = "block";                 
                document.getElementById("tra_PayPhone").style.display = "block";
                document.getElementById("tra_PayPhone").disabled = false;                                    
            }

            var p1 =document.getElementById("tra_Companion").value;
            if(p1 == "Si"){                
                
                document.getElementById("tra_CompanionNameLabel").style.display = "block";                 
                document.getElementById("tra_CompanionName").style.display = "block";
                document.getElementById("tra_CompanionName").disabled = false;                                                                   

                document.getElementById("tra_CompanionRelationLabel").style.display = "block";                 
                document.getElementById("tra_CompanionRelation").style.display = "block";
                document.getElementById("tra_CompanionRelation").disabled = false;                              
                
            }

            var p1 =document.getElementById("back_history").value;
            if(p1 == "Si"){                
                document.getElementById("bac_VisitHistory").style.display = "block";                 
                
                document.getElementById("bac_LegalLabel").style.display = "block";                 
                document.getElementById("bac_Legal").style.display = "block";
                document.getElementById("bac_Legal").disabled = false;    

                document.getElementById("bac_TimeAprox1Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox1").style.display = "block";
                document.getElementById("bac_TimeAprox1").disabled = false;                    

                document.getElementById("bac_DateAprox1Label").style.display = "block";                 
                document.getElementById("bac_DateAprox1").style.display = "block";
                document.getElementById("bac_DateAprox1").disabled = false;                    

                document.getElementById("bac_TimeAprox2Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox2").style.display = "block";
                document.getElementById("bac_TimeAprox2").disabled = false;                    

                document.getElementById("bac_DateAprox2Label").style.display = "block";                 
                document.getElementById("bac_DateAprox2").style.display = "block";
                document.getElementById("bac_DateAprox2").disabled = false;                    

                document.getElementById("bac_TimeAprox3Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox3").style.display = "block";
                document.getElementById("bac_TimeAprox3").disabled = false;                    

                document.getElementById("bac_DateAprox3Label").style.display = "block";                 
                document.getElementById("bac_DateAprox3").style.display = "block";
                document.getElementById("bac_DateAprox3").disabled = false;                    

                document.getElementById("bac_TimeAprox4Label").style.display = "block";                 
                document.getElementById("bac_TimeAprox4").style.display = "block";
                document.getElementById("bac_TimeAprox4").disabled = false;                    

                document.getElementById("bac_DateAprox4Label").style.display = "block";                 
                document.getElementById("bac_DateAprox4").style.display = "block";
                document.getElementById("bac_DateAprox4").disabled = false;                                    
            }

            var p1 =document.getElementById("hijo_History").value;            
            if(p1 == "No"){
                document.getElementById("hijo_NameLabel").style.display = "block";                 
                document.getElementById("hijo_Name").style.display = "block";
                document.getElementById("hijo_Name").disabled = false;                    

                document.getElementById("hijo_DireccionLabel").style.display = "block";                 
                document.getElementById("hijo_Direccion").style.display = "block";
                document.getElementById("hijo_Direccion").disabled = false;                    

                document.getElementById("hijo_BossLabel").style.display = "block";                 
                document.getElementById("hijo_Boss").style.display = "block";
                document.getElementById("hijo_Boss").disabled = false;                    

                document.getElementById("hijo_PhoneLabel").style.display = "block";                 
                document.getElementById("hijo_Phone").style.display = "block";
                document.getElementById("hijo_Phone").disabled = false;                    

                document.getElementById("hijo_DateLabel").style.display = "block";                 
                document.getElementById("hijo_Date").style.display = "block";
                document.getElementById("hijo_Date").disabled = false;                                        

                document.getElementById("hijo_NoteLabel").style.display = "block";                 
                document.getElementById("hijo_Note").style.display = "block";
                document.getElementById("hijo_Note").disabled = false;                                         

            }

            var p1 =document.getElementById("infoWeapons").value;            
            if(p1 == "Si"){
                document.getElementById("info_WeaponsInfoLabel").style.display = "block";                 
                document.getElementById("info_WeaponsInfo").style.display = "block";
                document.getElementById("info_WeaponsInfo").disabled = false;                    
                                        

            }
        
    });
 
    </script>


@stop