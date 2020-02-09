@extends('layouts.form')
@section('content1')
<p class="form-info-title">
    Felicidades!!!
</p>

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
                    <input required type="text" class="form-control" id="in_nombre" name="in_nombre" aria-describedby="" placeholder="Nombre(s)">
                </div>
            </div>                                  
            <div class="col-md-6">
                <div class="form-group">
                <label for="sel1">Apellidos(s)<span class="star"> *</span></label>
                    <input required type="text" class="form-control" id="in_apellidos" name="in_apellidos" aria-describedby="" placeholder="Apellidos(s)">
                </div>                
            </div>                                  
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">Correo electronico<span class="star"> *</span></label>
                    <input required type="email" class="form-control" id="in_email" name="in_email" aria-describedby="emailHelp" placeholder="Email">
                </div>
            </div>    

            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Contraseña</label>
                    <input required onblur="checkPassword()" type="password" class="form-control" id="in_password1" name="in_password1" aria-describedby="emailHelp" placeholder="Password">
                </div>
            </div>                                 
            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Verificar Contraseña</label>
                    <input required onblur="checkPassword()" type="password" class="form-control" id="in_password2" name="in_password2" aria-describedby="emailHelp" placeholder="Verificar password">
                </div>
            </div>                                 
                                          
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">Dirección</label>
                    <input type="text" class="form-control" id="in_address" name="in_address" aria-describedby="emailHelp" placeholder="Dirección">
                </div>
            </div>    

            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Num Ext.</label>
                    <input type="text" class="form-control" id="in_numExt" name="in_numExt" aria-describedby="emailHelp" placeholder="#">
                </div>
            </div>                                 
            <div class="col-md-3">
            <div class="form-group">
                <label for="sel1">Num Int.</label>
                    <input type="text" class="form-control" id="in_numInt" name="in_numInt" aria-describedby="emailHelp" placeholder="#">
                </div>
            </div>                                                                           
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sel1">Estado</label>
                    <input type="text" class="form-control" id="in_state" name="in_state" aria-describedby="emailHelp" placeholder="Estado">
                </div>
            </div>    

            <div class="col-md-3">
                <div class="form-group">
                <label for="sel1">Ciudad</label>
                    <input type="text" class="form-control" id="in_city" name="in_city" aria-describedby="emailHelp" placeholder="Ciudad">
                </div>
            </div>                                 
            <div class="col-md-3">
            <div class="form-group">
                <label for="sel1">C.P.</label>
                    <input type="number" class="form-control" id="in_cp" name="in_cp" aria-describedby="emailHelp" placeholder="00000">
                </div>
            </div>                                                                           
            <div class="col-md-3">
            <div class="form-group">
                <label for="sel1">Colonia</label>
                    <input type="text" class="form-control" id="in_colonia" name="in_colonia" aria-describedby="emailHelp" placeholder="Colonia">
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
                            <input id="paypal" name="paypal" type="radio" class="custom-control-input" checked>
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label for="cc-name">Nombre en la tarjeta</label>
                <input type="text" id="name_target" name="name_target" class="form-control" placeholder="" >            
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="cc-number">Numero en la tarjeta</label>
                <input type="text" id="num_target" name="num_target" class="form-control" placeholder="" >            
            </div>
          </div>
        </div>        
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
                <label for="cc-expiration">Mes</label>
                <input type="number" class="form-control" id="month_target" name="month_target" placeholder="" >            
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
                <label for="cc-cvv">Año</label>
                <input type="number" class="form-control" id="year_target" name="year_target" placeholder="" >
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
                <label for="cc-cvv">CVV</label>
                <input type="password" class="form-control" id="cvv_target" name="cvv_target" placeholder="" >
            </div>
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-3">
                <div class="form-group">
                <label for="cc-cvv"></label>
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Total de pedido $1,200.00</span>                    
                    </h4>                
                </div>
            </div>
        </div> -->

        
    </div> 
</div>       
<div id="divErrores" style="display: none">
    <h5 style="color: red;">Errores</h6>
    <label id="labelAdvertencias" style="color:red; font-size: 12px;" for=""></label>
</div>              


<button type="submit" id="inputSubmit" class="btn btn-primary">Siguiente</button>
</form>


<script>
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
