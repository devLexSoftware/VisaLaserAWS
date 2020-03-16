@extends('layouts.form')
@section('content1')
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

<form id="firtsRegister" action="registerPaymethod" method="post" enctype="multipart/form-data">
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
                    <input value="{{ old('in_nombre') }}" required type="text" class="form-control" id="in_nombre" name="in_nombre" aria-describedby="" placeholder="Nombre(s)">
                </div>
            </div>                                  
            <div class="col-md-6">
                <div class="form-group">
                <label for="sel1">Apellidos(s)<span class="star"> *</span></label>
                    <input value="{{ old('in_apellidos') }}"  required type="text" class="form-control" id="in_apellidos" name="in_apellidos" aria-describedby="" placeholder="Apellidos(s)">
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
                    <label for="sel1">Dirección</label>
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
                            <input id="paymethod" name="paymethod" onclick="MetodoPago(this)" value="paypal" type="radio" class="custom-control-input" checked>
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        
                            <input id="paymethod" name="paymethod" onclick="MetodoPago(this)" value="tarjeta" type="radio" class="custom-control-input">
                            <label class="custom-control-label" for="conekta">Tarjeta</label>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row" id="divTarjeta" style="display:none">
            <div class="col-md-3">
                <span class="card-errors"></span>
                <div class="form-group">
                    <label>
                    <span>Nombre del tarjetahabiente</span>
                    <input class="form-control" id="nomTarjeta" type="text" maxlength="40" data-conekta="card[name]">
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <label>
                    <span>Número de tarjeta de crédito</span>
                    <input class="form-control" id="numTarjeta" type="number" size="20" data-conekta="card[number]">
                    </label>
                </div>
            </div>
        
            <div class="col-md-2">
                <div class="form-group">
                    <label>
                    <span>CVC</span>
                    <input class="form-control" id="cvcTarjeta" type="number" size="4" data-conekta="card[cvc]">
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>
                    <span>Fecha de expiración (MM/AAAA)</span>
                    <input  type="number" size="2" id="mmTarjeta" data-conekta="card[exp_month]">
                    </label>
                    <span>/</span>
                    <input type="number" size="4" id="yyTarjeta" data-conekta="card[exp_year]">
                </div>
            </div>            

                <!-- <button type="submit">Crear token</button> -->
            </div>
        </div>    
    </div> 
</div>       
<div id="divErrores" style="display: none">
    <h5 style="color: red;">Errores</h6>
    <label id="labelAdvertencias" style="color:red; font-size: 12px;" for=""></label>
</div>              


<button type="submit" onclick="loadSpinner()" id="inputSubmit" class="btn btn-primary">Siguiente</button>
</form>


<script>

function loadSpinner(){
    
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

    }
    else{
        document.getElementById("nomTarjeta").required = true;
        document.getElementById("numTarjeta").required = true;
        document.getElementById("cvcTarjeta").required = true;
        document.getElementById("mmTarjeta").required = true;
        document.getElementById("yyTarjeta").required = true;

        document.getElementById("divTarjeta").style.display = "block";
        
    }
}

function checkPassword(){
    debugger

    var p1 =document.getElementById("in_password1").value;
    var p2 =document.getElementById("in_password2").value;

    if(p1 != p2){
        document.getElementById("divErrores").style.display = "block";
        document.getElementById("inputSubmit").disabled = true;
        document.getElementById("labelAdvertencias").innerText = "Las contraseñas no concuerdan";
    }
    else{
        document.getElementById("divErrores").style.display = "none";
        document.getElementById("inputSubmit").disabled = false;
        document.getElementById("labelAdvertencias").innerText = "";
    }
}
</script>


<!-- <a href="{{ url('subscribe/paypal') }}"><img src="/images/paypal-btn.png"></a> -->
<!-- 
 <a href="{{ route('payment') }}" class="btn btn-warning">
    Pagar con <i class="fa fa-cc-paypal fa-2x"></i>
</a> -->

@stop
