<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <img width="50" height="50" src="/images/logo_1.png" class="img-responsive">
        </div>
        <div class="sidebar-brand-text mx-3">VISA LASER </div>
      </a>
 
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('admin') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Clientes
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('clientesPendientes')}}">          
          <span>Clientes Pago Pendiente</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('clientesNoRevisados')}}" >          
          <span>Clientes Sin Revisar</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('clientesRevisadas')}}" >          
          <span>Clientes Revisados </span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('clientes')}}" >          
          <span>Todos los Clientes</span></a>
      </li>


      <!-- <hr class="sidebar-divider d-none d-md-block">

      <li class="nav-item">
        <a class="nav-link" href="charts.html">          
          <span></span>Historial de pagos</span></a>
      </li> -->

      <!-- Nav Item - Utilities Collapse Menu -->
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>