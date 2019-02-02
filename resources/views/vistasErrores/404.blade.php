@extends('layouts.templateBasico')

@section('titulo') 404 - Pagina no encontrada @stop

@section('estilos')
@parent
  <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('css/styles-main-gesol.css') }}" />
@stop

@section('contenido')

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- 404 Error Text -->
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Pagina no encontrada</p>
    <p class="text-gray-500 mb-0">Parece que has encontrado un agujero en la matrix...</p>
    <a href="/">&larr; Regresar</a>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

</div>
<!-- /.container-fluid -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  @section('javascript')
    @parent
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/dashboard/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/dashboard/sb-admin-2.min.js') }}"></script>
  @stop

</body>

</html>
