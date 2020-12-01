@extends('layouts.form')
@section('content1')
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

<form id="card-form" action="registerPaymethod" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="panel panel-primary"> 
    <div class="panel-heading"> 
        <h3 class="panel-title">Información</h3> 
    </div> 
    <div class="panel-body">    
                             
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">Nombre(s) del solicitante<span class="star"> *</span></label>
                    <input value="{{ old('in_nombre') }}" pattern="[a-zA-Z ]{2,254}" title="No se aceptan números" required type="text" class="form-control" id="in_nombre" name="in_nombre" aria-describedby="" placeholder="Nombre(s)">
                </div>
            </div>                                  
            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Apellido Paterno del solicitante<span class="star"> *</span></label>
                    <input value="{{ old('in_apellidoPaterno') }}" pattern="[a-zA-Z ]{2,254}" title="No se aceptan números" required type="text" class="form-control" id="in_apellidoPaterno" name="in_apellidoPaterno" aria-describedby="" placeholder="Apellido">
                </div>                
            </div>                                
            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Apellido Materno del solicitante<span class="star"> *</span></label>
                    <input value="{{ old('in_apellidoMaterno') }}" pattern="[a-zA-Z ]{2,254}" title="No se aceptan números" required type="text" class="form-control" id="in_apellidoMaterno" name="in_apellidoMaterno" aria-describedby="" placeholder="Apellido">
                </div>                
            </div>                                  
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sel1">Sexo<span class="star"> *</span></label>
                    <select class="form-control" id="in_sex" required name="in_sex">
                        <option disabled selected>Seleccione</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select>  
                </div>
            </div>                                  
            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Fecha Nacimiento<span class="star"> *</span></label>                    
                    <input value="{{ old('in_fecha') }}" onblur="calculateYear(this)"  required type="date" class="form-control" id="in_birthday" name="in_birthday"placeholder="Fecha">
                    <input  type="hidden" id="in_year" name="in_year">

                </div>                
            </div>                                  


            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Teléfono móvil<span class="star"> *</span></label>                    
                    <input value="{{ old('in_movil') }}" pattern="[1-9]{1}[0-9]{9}" title="Ingresa 10 dígitos" required type="text"  class="form-control" id="in_movil" name="in_movil" placeholder="Móvil">                    
                </div>                
            </div>           
            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Teléfono Particular<span class="star"> *</span></label>                    
                    <input value="{{ old('in_phone') }}" pattern="[1-9]{1}[0-9]{9}" title="Ingresa 10 dígitos" required type="text"  class="form-control" id="in_phone" name="in_phone" placeholder="Móvil">                    
                </div>                
            </div>           
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">Correo electronico<span class="star"> *</span></label>
                    <input value="{{ old('in_email') }}" required type="email" class="form-control" id="in_email" name="in_email" aria-describedby="emailHelp" placeholder="Email">
                </div>
            </div>    

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sel1">Contraseña</label>
                    <input  required onblur="checkPassword()" type="password" class="form-control" id="in_password1" name="in_password1" aria-describedby="emailHelp" placeholder="Password">
                    <small class="form-text text-muted" style="color: #3e88bd">No es necesario que utilice su contraseña personal.</small>
                </div>
            </div>                                 
            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Verificar Contraseña</label>
                    <input  required onblur="checkPassword()" type="password" class="form-control" id="in_password2" name="in_password2" aria-describedby="emailHelp" placeholder="Verificar password">
                </div>
            </div>                                 
                                          
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">Calle</label>
                    <input value="{{ old('in_address') }}" type="text" class="form-control" id="in_address" name="in_address" aria-describedby="emailHelp" placeholder="Dirección">
                </div>
            </div>    

            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Num Ext.</label>
                    <input value="{{ old('in_numExt') }}" type="text" class="form-control" id="in_numExt" name="in_numExt" aria-describedby="emailHelp" placeholder="#">
                </div>
            </div>                                 
            <div class="col-md-3">
            <div class="form-group">
                <label for="sel1">Num Int.</label>
                    <input value="{{ old('in_numInt') }}" type="text" class="form-control" id="in_numInt" name="in_numInt" aria-describedby="emailHelp" placeholder="#">
                </div>
            </div>                                                                           
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sel1">Estado</label>
                    <input value="{{ old('in_state') }}" type="text" class="form-control" id="in_state" name="in_state" aria-describedby="emailHelp" placeholder="Estado">
                </div>
            </div>    

            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Ciudad</label>
                    <input value="{{ old('in_city') }}" type="text" class="form-control" id="in_city" name="in_city" aria-describedby="emailHelp" placeholder="Ciudad">
                </div>
            </div>                                 
            <div class="col-md-3">
            <div class="form-group">
                <label for="sel1">C.P.</label>
                    <input value="{{ old('in_cp') }}" type="number" class="form-control" id="in_cp" name="in_cp" aria-describedby="emailHelp" placeholder="00000">
                </div>
            </div>                                                                           
            <div class="col-md-3">
            <div class="form-group">
                <label for="sel1">Colonia</label>
                    <input value="{{ old('in_colonia') }}" type="text" class="form-control" id="in_colonia" name="in_colonia" aria-describedby="emailHelp" placeholder="Colonia">
                </div>
            </div>                                                                           
        </div>

        <hr>
        

        <div class="form-group">
            <h3>Metodo de pago</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="d-block my-3">
                        <!-- <div class="custom-control custom-radio">
                            <input id="credit" name="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" >
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="debit" type="radio" class="custom-control-input" >
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div> -->
                        <div class="custom-control custom-radio">
                            <input id="paymethod" name="paymethod" onclick="MetodoPago(this)" value="paypal" type="radio" class="custom-control-input">
                            <!-- <label class="custom-control-label" style="margin-right: 100px;" for="paypal">PayPal</label>e -->
                            <img src="{{ asset('images/paypal.png') }}" style="margin-right: 100px;" border="0" alt="PayPal ">
                        
                            <input id="paymethod" name="paymethod" onclick="MetodoPago(this)" value="tarjeta" type="radio" class="custom-control-input">
                            <!-- <label class="custom-control-label" for="conekta">Tarjeta</label> -->
                            <img src="{{ asset('images/visamastercard.png') }}" style="margin-right: 100px; width:120px;" border="0" alt="PayPal ">

                            <input type="hidden" id="metodoPagoPreferente" name="metodoPagoPreferente" value="paypal">
                            <input type="hidden" id="costoTotal" name="costoTotal" value="0">
                        </div>
                    </div>
                </div>
            </div>            
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

            <!-- <div class="row">        
                <div class="col-md-2">
                    <div class="form-group">
                        <label>CVC</label>
                        <input class="form-control" id="cvcTarjeta" type="number" size="4" data-conekta="card[cvc]">
                        
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Fecha de expiración</label>
                        <input class="form-control  type="number" size="2" id="mmTarjeta" data-conekta="card[exp_month]">                                                                    
                        <small class="form-text text-muted" style="color: #3e88bd">MM</small>

                    </div>
                </div>      
                <div class="col-md-2">
                    <div class="form-group">                        
                        <label></label>

                        <input class="form-control type="number" size="4" id="yyTarjeta" data-conekta="card[exp_year]">
                        <small class="form-text text-muted" style="color: #3e88bd">YY</small>
                    </div>
                </div>      
            </div> -->
            
        </div>
    </div>
</div>  




<div id="divErrores" style="display: none">
    <h5 style="color: red;">Errores</h6>
    <label id="labelAdvertencias" style="color:red; font-size: 12px;" for=""></label>
</div>              


<button type="submit"  id="inputSubmit" class="btn btn-primary" disabled>Siguiente</button>
</form>



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


<script>


function calculateYear(x){        
    var hoy = new Date();
    var cumpleanos = new Date(x.value);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }    
    document.getElementById("in_year").value = edad;       
    costoVisa();
}

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
        document.getElementById("inputSubmit").disabled = false;



    }
    else{
        document.getElementById("nomTarjeta").required = true;
        document.getElementById("numTarjeta").required = true;
        document.getElementById("cvcTarjeta").required = true;
        document.getElementById("mmTarjeta").required = true;
        document.getElementById("yyTarjeta").required = true;

        document.getElementById("divTarjeta").style.display = "block";        
        document.getElementById("metodoPagoPreferente").value = "tarjeta";
        document.getElementById("inputSubmit").disabled = false;

        
    }
    costoVisa();
}

function checkPassword(){
    debugger;
    var p1 =document.getElementById("in_password1").value;
    var p2 =document.getElementById("in_password2").value;
    
    var pay = document.querySelector('input[name="paymethod"]:checked');


    if(p1 != p2){
        document.getElementById("divErrores").style.display = "block";
        document.getElementById("labelAdvertencias").innerText = "Las contraseñas no concuerdan";
        document.getElementById("inputSubmit").disabled = true;

        if(pay == null)
            document.getElementById("inputSubmit").disabled = true;

    }    
    else{
        document.getElementById("divErrores").style.display = "none";
        
        document.getElementById("labelAdvertencias").innerText = "";
        document.getElementById("inputSubmit").disabled = false;

        if(pay == null)
            document.getElementById("inputSubmit").disabled = true;
    }
}



</script>


<!-- <a href="{{ url('subscribe/paypal') }}"><img src="/images/paypal-btn.png"></a> -->
<!-- 
 <a href="{{ route('payment') }}" class="btn btn-warning">
    Pagar con <i class="fa fa-cc-paypal fa-2x"></i>
</a> -->

@stop
