@extends('layouts.dashboard')

@section('content')
 

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="row">
      <div class="col-md-12">
      <h3>Clientes sin Revisar</h3>
      </div>      
    </div>  
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <div class="topbar-divider d-none d-sm-block"></div>
      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="font-size:20px;">Cerrar Sesión</span>          
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">                    
          <a class="dropdown-item" href="logout">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cliente</h1>
<p class="mb-4"> Listado de Clientes.</a></p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id Cliente</th>
            <th>Nombre</th>
            <th>Apellidos</th>            
            <th>Fecha de registro</th>
            <th>Estatus</th>
            <th>Revisar</th>
          </tr>
        </thead>
       
        <tbody>
        @if($customer->count())  
            @foreach($customer as $item)  
              <tr>
                <td>{{$item->curId}}</td>
                <td>{{$item->cuFirst}}</td>
                <td>{{$item->cuLast}}</td>
                <td>{{$item->trDateTime}}</td>
                <td>{{$item->trStatus}}</td>                
                
                <td>
                <a href="{{ route('clientesEdicion', $item->usId) }}" class="btn btn-xs btn-info pull-right">Revisar</a>

                </td>
              </tr>
            @endforeach 
          @else
            <tr>
              <td colspan="8">No hay registro !!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>

</div>

@stop