@extends('layouts.dashboard')

@section('content')


<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

  </nav>

  
			@if(Session::has('success'))
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif

<div class="container-fluid">
<form action="/clientesEdicion/{{$customer[0]->usId}}" method="POST" >
  {{ csrf_field() }}

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Cliente</h1>
    <p class="mb-4"> Edición cliente</a></p>
    
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
                        <input value="{{$customer[0]->trCurrency}}"  type="text" class="form-control" id="basic_nombre" name="basic_nombre" aria-describedby="" placeholder="Nombre(s)">
                        
                    </div>
                </div>                                  
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="sel1">Fecha registro<span class="star"> *</span></label>
                        <input value="{{$customer[0]->trdate}}" type="text" class="form-control" id="basic_apellidos" name="basic_apellidos" aria-describedby="" placeholder="Apellidos(s)">
                    </div>                
                </div>                                  
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="sel1">Status<span class="star"> *</span></label>
                        <input value="{{$customer[0]->trStatus}}" type="text" class="form-control" id="basic_apellidos" name="basic_apellidos" aria-describedby="" placeholder="Apellidos(s)">
                    </div>                
                </div>                                  
            </div>
        </div>
      </div>    
    </div>


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
                        <input value="{{$customer[0]->cuFirst}}" required  type="text" class="form-control" id="basic_nombre" name="basic_nombre" aria-describedby="" placeholder="Nombre(s)">
                        <input value="{{$customer[0]->curId}}" required type="hidden" class="form-control" id="basic_cuId" name="basic_cuId" aria-describedby="" placeholder="Nombre(s)">                                    
                        <input value="{{$customer[0]->usId}}" required type="hidden" class="form-control" id="basic_usId" name="basic_usId" aria-describedby="" placeholder="Nombre(s)">
                    </div>
                </div>                                  
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="sel1">Apellidos(s)<span class="star"> *</span></label>
                        <input value="{{$customer[0]->cuLast}}" type="text" class="form-control" id="basic_apellidos" name="basic_apellidos" aria-describedby="" placeholder="Apellidos(s)">
                    </div>                
                </div>                                  
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sel1">Correo electronico</label>
                        <input value="{{$customer[0]->usEmail}}"  type="email" class="form-control" id="basic_email" name="basic_email" aria-describedby="emailHelp" placeholder="Email">
                        <input value="{{$customer[0]->usId}}" type="hidden" class="form-control" id="basic_usId" name="basic_usId" aria-describedby="" placeholder="Carrera">
                    </div>
                </div>    

                <div class="col-md-3">
                    <div class="form-group">
                    <label for="sel1">Contraseña</label>
                        <input  type="password" class="form-control" id="basic_password1" name="basic_password1" aria-describedby="emailHelp" placeholder="Password">
                    </div>
                </div>                                                             
                                            
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="sel1">Dirección</label>
                        <input value="{{$customer[0]->cuAddress}}"  type="text" class="form-control" id="basic_address" name="basic_address" aria-describedby="emailHelp" placeholder="Dirección">
                    </div>
                </div>                                                                                                          
            </div>                        

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sel1">Fecha nacimiento</label>
                        <input value="{{$customer[0]->cuBirthday}}"  required required type="date" class="form-control" id="basic_birthday" name="basic_birthday" aria-describedby="emailHelp" placeholder="Fecha">
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
                    <label for="sel1">Telefono</label>
                    <input value="{{$customer[0]->cuTelephone}}" required required type="text" class="form-control" id="basic_phone" name="basic_phone" aria-describedby="emailHelp" placeholder="Telefono">
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
                                        <input value="{{$customer[0]->coName}}" type="text" class="form-control" id="contact_nombre" name="contact_nombre" aria-describedby="" placeholder="Nombre(s)">
                                        <input value="{{$customer[0]->coId}}" type="hidden" class="form-control" id="contact_coId" name="contact_coId" aria-describedby="" placeholder="Carrera">
                                    </div>
                                </div>                                  
                                
                            </div>     

                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sel1">Relación</label>
                                        <input value="{{$customer[0]->coRelationship}}"  type="text" class="form-control" id="contact_relation" name="contact_relation" aria-describedby="emailHelp" placeholder="Relación">
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
                                        <input value="{{$customer[0]->paNameMother}}" type="text" class="form-control" id="parent_nameMother" name="parent_nameMother" aria-describedby="" placeholder="Nombre(s)">
                                        <input value="{{$customer[0]->paId}}" type="hidden" class="form-control" id="parent_paId" name="parent_paId" aria-describedby="" placeholder="Carrera">
                                    </div>
                                </div>                                  
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="sel1">Estado migratorio<span class="star"> *</span></label>
                                        <input value="{{$customer[0]->paStatusMigratoryMother}}" type="text" class="form-control" id="parent_motherStatus" name="parent_motherStatus" aria-describedby="" placeholder="Estado">
                                    </div>                
                                </div>       
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="sel1">Fecha de nacimiento <span class="star"> *</span></label>
                                    <input value="{{$customer[0]->paBirthdayMother}}" type="date" class="form-control" id="parent_motherBirthday" name="parent_motherBirthday" aria-describedby="" placeholder="Fecha">
                                    </div>                
                                </div>                                  
                            </div>     

                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sel1">Nombre del padre<span class="star"> *</span></label>
                                        <input value="{{$customer[0]->paNameFather}}" type="text" class="form-control" id="parent_nameFather" name="parent_nameFather" aria-describedby="" placeholder="Nombre(s)">
                                    </div>
                                </div>                                  
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="sel1">Estado migratorio<span class="star"> *</span></label>
                                        <input value="{{$customer[0]->paStatusMigratoryFather}}" type="text" class="form-control" id="parent_fatherStatus" name="parent_fatherStatus" aria-describedby="" placeholder="Estado">
                                    </div>                
                                </div>       
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="sel1">Fecha de nacimiento <span class="star"> *</span></label>
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sel1">Ultimo grado de estudios<span class="star"> *</span></label>
                        <input value="{{$customer[0]->edLEvel}}" type="text" class="form-control" id="education_grade" name="education_grade" aria-describedby="" placeholder="Nombre">
                        <input value="{{$customer[0]->edId}}" type="hidden" class="form-control" id="education_edId" name="education_edId" aria-describedby="" placeholder="Carrera">
                    </div>
                </div> 
                                                
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="sel1">Fecha de ingreso<span class="star"> *</span></label>
                    <input value="{{$customer[0]->edAdmission}}" type="date" class="form-control" id="education_ingress" name="education_ingress" aria-describedby="" placeholder="Fecha">
                    </div>                
                </div>                                  
                <div class="col-md-3">
                    <div class="form-group">
                    <label for="sel1">Fecha de egreso<span class="star"> *</span></label>
                    <input value="{{$customer[0]->edEgress}}" type="date" class="form-control" id="education_egress" name="education_egress" aria-describedby="" placeholder="Fecha">
                    </div>                
                </div>                                  
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sel1">Nombre del instituto de ultimo grado de estudios<span class="star"> *</span></label>
                        <input value="{{$customer[0]->edSchool}}" type="text" class="form-control" id="education_name" name="education_name" aria-describedby="" placeholder="Nombre">
                    </div>
                </div> 
                                                
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="sel1">Ciudad donde se encuentra el instituto<span class="star"> *</span></label>
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
                    <label for="sel1">Dirección de la empresa<span class="star"> *</span></label>
                        <input value="{{$customer[0]->joAddress}}" type="text" class="form-control" id="job_direction" name="job_direction" aria-describedby="" placeholder="Dirección">
                    </div>                
                </div>                                                              
            </div>

            <div class="row">
              <div class="col-md-6">
                      <div class="form-group">
                      <label for="sel1">Principales actividades<span class="star"> *</span></label>
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
                    <label for="sel1">Carrera<span class="star"> *</span></label>
                        <input value="{{$customer[0]->joCarrer}}" type="text" class="form-control" id="job_carrer" name="job_carrer" aria-describedby="" placeholder="Carrera">
                    </div>                
                </div>                                                              
            </div>

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

@stop

