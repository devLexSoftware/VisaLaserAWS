@extends('layouts.form')
@section('content1')

<p class="form-info-title" style="text-align: center; font-size:30px;">
    Importante
</p>
<p class="form-info" style="text-align:justify">
Visa Laser Mexico, no proporcionará información telefónica a solicitantes
que no cuenten con un registro en nuestra página. Una vez que usted se haya registrado y
haya realizado el pago, nuestro personal se pondrá en contacto con usted para continuar
con el trámite de su VISA, y de esta manera resolver todas sus dudas.
Problemas con su pago envíe un correo a: pagos@visalaser.com.mx
</p>
@stop
 
@section('content2')
<div class="col-md-12 order-md-12">
    <h2 class="mb-3"> Registro</h2>
    <h4 class="mb-3" style="text-align:justify">Por medio del siguiente cuestionario, usted podrá saber si cumple con las condiciones para aplicar
para este tipo de Visa de turista categoría B1/B2 en los Consulados o Embajada de Los Estados
Unidos en México.</h4>
    <br>
<br>
</div>
@stop

@section('content3')

<form id="firtsRegister" action="registerStatus" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="panel panel-primary"> 
    <div class="panel-heading"> 
        <h3 class="panel-title">Información</h3> 
    </div> 
    <div class="panel-body">    
                             
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">¿Es usted ciudadano Mexicano o residente legal en México?<span class="star"> *</span></label>
                    <select class="form-control" id="pregunta_1" name="pregunta_1" onchange="OptionInitial(this)">
                        <option value="" disabled="" selected="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <small id="error_1" class="form-text text-muted alert-form">                    
                    </small>

                </div>
            </div>                                  
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">¿Cuál es el propósito de viaje a Los Estados Unidos?<span class="star"> *</span></label>
                    <select class="form-control" id="pregunta_2" name="pregunta_2" onchange="OptionInitial(this)">
                        <option value="" disabled="" selected="">Selecciona una opción</option>
                        <option value="Turismo">Turismo</option>
                        <option value="Negocios">Negocios</option>
                        <option value="Familia">Visitar amigos o familiares</option>
                        <option value="Transito">En tránsito hacia otro país</option>
                        <option value="Empleo">Motivos de mi trabajo o empleo o salud</option>
                        <option value="Enfermo">Visitar a un familiar directo que se encuentra muy enfermo</option>
                        <option value="Deporte">Participar en un torneo o competencia deportiva</option>
                        <option value="Estudio">Estudiar en Los Estados Unidos</option>
                        <option value="Trabajar">Trabajar en Los Estados Unidos</option>
                    </select>
                    <small id="error_2" class="form-text text-muted alert-form"></small>
                </div>                
            </div>                                  
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">¿Cuánto tiempo pretende permanecer en Los Estados Unidos?</label>
                    <select class="form-control" id="pregunta_3" name="pregunta_3" onchange="OptionInitial(this)">
                        <option value="" disabled="" selected="">Selecciona una opción</option>
                        <option value="1">Menos de un mes</option>
                        <option value="2">De uno a seis meses</option>
                        <option value="3">Mas de seis meses</option>
                    </select>
                    <small id="error_3" class="form-text text-muted alert-form"></small>
                </div>
            </div>    

            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">¿Cuenta usted con lazos fuertes en México o en su país de origen?</label>
                    <select class="form-control" id="pregunta_4" name="pregunta_4" onchange="OptionInitial(this)">
                        <option value="" disabled="" selected="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <small id="error_4" class="form-text text-muted alert-form"></small>
                </div>
            </div>                                 
                                          
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">¿Pertenece usted a algún grupo terrorista u organización delictiva en México o en el extranjero?</label>
                    <select class="form-control" id="pregunta_5" name="pregunta_5" onchange="OptionInitial(this)">
                        <option value="" disabled="" selected="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <small id="error_5" class="form-text text-muted alert-form"></small>
                </div>
            </div>                                  

            <div class="col-md-6">
                <div class="form-group">
                    <label for="sel1">¿Tiene intensiones de vivir permanentemente en Los Estados Unidos?</label>
                    <select class="form-control" id="pregunta_6" name="pregunta_6" onchange="OptionInitial(this)">
                        <option value="" disabled="" selected="">Selecciona una opción</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <small id="error_6" class="form-text text-muted alert-form"></small>
                </div>
            </div>    

        </div>
    </div> 
</div>                     
<button type="submit" class="btn btn-primary">Siguiente</button>
</form>

@stop