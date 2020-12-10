@extends('layouts.form')
@section('content1')

<h3 style="text-align: center;">
En base a sus respuestas proporcionadas usted SI califica para aplicar para una Visa
de turista categoría B1/B2 para los Estados Unidos.
</h3>
@stop
 
@section('content2')
<br>
<hr>
<h4 style="text-align: justify;">
A continuación usted podrá obtener una guía completa en Español para
continuar con el trámite de su Visa
</h4>

<h4 style="text-align: justify;">
Con esta guía usted podrá tramitar por primera vez o renovar su Visa Americana de Turista
categoría B1/B2 sin ningún contratiempo. 
</h4>
<h4 style="text-align: justify;">
El costo es de $55 USD por solicitante para personas
mayores de 21 años de edad y de $ 35 USD para solicitantes menores de 21 años de edad e
incluye lo siguiente:
</h4>

<div class="panel-body">    
    <div class="row">
        <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item">Elaboración en ingles de solicitud de Visa formulario DS-160</li>
            <li class="list-group-item">Asistencia telefónica en español y por e-mail para el trámite de Visa </li>
            <li class="list-group-item">Documentos y requisitos que deberá presentar en sus entrevistas </li>
            <li class="list-group-item">Concertación de cita o citas en el CAS, Embajada o Consulado de su elección </li>
            <li class="list-group-item">Registro en la página de citas y pagos de la Embajada</li>
            <li class="list-group-item">Selección de la oficina DHL en la cual usted recibirá su VISA en caso de ser aprobada </li>
            <li class="list-group-item">Evaluación final de su expediente </li>
            <li class="list-group-item">Preparación y recomendaciones para su entrevista Consular</li>
            <li class="list-group-item">Obtención de su número de expediente o “Application ID”</li>
        </ul>
        </div>
    </div>
</div>

<!-- 
<div>
    <div class="row">
        <div class="col-md-6">
            <p for="" style="text-align: center; font-size:18px; font-weight: bold;">
            Pago mayores de 21 años $ 55 USD
            </p>
        </div>
        <div class="col-md-6">
            <p for="" style="text-align: center; font-size:18px; font-weight: bold;">
            Pago menores de 21 años $ 35 USD
            </p>
        </div>
    </div>
</div> -->

<h4  style="text-align: center;" class="form-info-title">Este pago no es reembolsable y no incluye los pagos Consulares. 
</h4>
<br>
<hr>

@stop
@section('content3')
<h4 style="text-align: justify;">El precio de esta guía está reflejado en dólares Americanos, sin embargo el cargo a su tarjeta
de crédito o débito se verá reflejado en su moneda local al tipo de cambio del día.
No es necesario que usted tenga una cuenta en dólares para realizar el pago</h4>

<hr>
<br>
<h4>En caso de requerir factura, enviar sus datos de facturación al correo  pagos@csc-americanvisa-mexico.com</h4>
<a href="registerUser"  class="btn btn-success" style="font-size:18px; font-weight: bold;">Registar y pagar</a>
@stop