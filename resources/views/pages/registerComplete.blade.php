@extends('layouts.formComplete')
@section('content1')
<p class="form-info-title">
    Felicidades!!!
</p>

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
                    <label for="sel1">Nombre(s)<span class="star"> *</span></label>
                    <input type="text" class="form-control" id="in_nombre" aria-describedby="" placeholder="Nombre(s)">
                </div>
            </div>                                  
            <div class="col-md-6">
                <div class="form-group">
                <label for="sel1">Apellidos(s)<span class="star"> *</span></label>
                    <input type="text" class="form-control" id="in_apellidos" aria-describedby="" placeholder="Apellidos(s)">
                </div>                
            </div>                                  
        </div>

        
</div>                     
<!-- <button type="submit" class="btn btn-primary">Siguiente</button> -->
</form>

@stop
