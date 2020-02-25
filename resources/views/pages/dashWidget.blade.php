


<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Pagos</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">${{$data[0]}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clientes atendidos</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data[1]}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa- fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

       <!-- Earnings (Monthly) Card Example -->
       <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clientes Pendientes</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data[2]}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa- fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clientes Sin Revisar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data[3]}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa- fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>



<br>
<hr>

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


