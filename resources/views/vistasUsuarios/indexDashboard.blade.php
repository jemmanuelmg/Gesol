@extends ('layouts.templateDashboard')

@section('contenido')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
<a href="/grafico1" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Descargar Reportes </a>
</div>

<!-- Content Row -->
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">

        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Solicitudes en total</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$cantSol}}</div>
            </div>

            <div class="col">
              <div class="progress progress-sm mr-2">
                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              
            </div>
          </div>
        </div>

        <div class="col-auto">
          <i class="fas fa-edit fa-2x text-gray-300"></i>
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
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Respuestas en total</div>
          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$cantResp}}</div>
        </div>
        <div class="col-auto">
          <i class="far fa-arrow-alt-circle-left fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Usuarios</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$cantUsu}}</div>
            </div>

          </div>
        </div>

        <div class="col-auto">
          <i class="fas fa-users fa-2x text-gray-300"></i>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Funcionarios</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantCompa}}</div>
        </div>
        <div class="col-auto">
          <i class="fas fa-comments fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Content Row -->
<div class="row">
<div class="col-md-12">

  <!-- Illustrations -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Bienvenido al panel de Admin.</h6>
    </div>
    <div class="card-body">
      <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
      </div>
      <p style="text-align: justify;">

        En este apartado podrás disponer de todas las funcionalidades reservadas para 
        los administradores encargados de cada Institución Educativa. 

        <br>
        <br>

        Dando clic en los íconos del panel lateral tendrás la posibilidad de 
        ver toda la información sobre usuarios solicitantes, aquellas personas
        que colaboran con su IE para resolver solicitudes (secretaria/os, docentes, decanos) y también, acceder a las respuestas
        enviadas que ya han terminado su proceso de trámite. El panel puede contraerse con el botón
        ubicado en la parte baja.

        <br>
        <br>

      </p>
      <p style="text-align: justify;">
        <img src="{{ asset('images/rotate-device.png') }}" class="imagen-float" id="img-rotate-screen">
        Si se encuentra visualizando la aplicación desde un dispositivo móvil, es recomendable
        ponerlo en posición horizontal para una experiencia mas cómoda.

      </p>
      
    </div>
  </div>

</div>
</div>


@stop