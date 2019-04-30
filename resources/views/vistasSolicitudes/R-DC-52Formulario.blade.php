@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')

    <!-- CONTENEDOR PARA FORMULARIO R-DC-52 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    <h1 class="encabezado-solicitudes"><center><strong>Inscripción Curso de Vacaciones</strong></center></h1>

                    <br>

                    <hr class="linea-encabezado">

                    <br>

                    <h3 class="subencabezado">Ingresar Datos</h3>

                    {!!Form::open(['route' => ['solicitudes.store'], 'files' => true, 'method'=>'POST'])!!}     

                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" value="R-DC-52" name="codSol" class="form-control">
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="apellidos">Apellidos *</label>
                        <div class="input-group">
                            <input type="text" name="apellidos" value="{{session('usu_apellidos')}}" size="30" class="form-control" readonly >
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="nombres">Nombres *</label>
                        <div class="input-group">
                            <input type="text" name="nombres" value="{{session('usu_nombres')}}" size="30" class="form-control" readonly > 
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="cedula">Documento de Identificacion *</label>
                        <div class="input-group">
                            <input type="number" name="cedula" value="{{session('usu_cedula')}}" size="30" class="form-control" readonly > 
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="programa">Programa Academico *</label>
                        <input type="text" name="programa" size="30" class="form-control" placeholder="Introduzca su programa académico" required>           
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="jornada">Jornada *</label>
                        <div class="input-group">
                            <select name="jornada" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option value="Seleccione">Seleccione</option>
                                <option value="Nocturna">Nocturna</option>
                                <option value="Diurna">Diurna</option>
                            </select>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="email">Correo Electronico *</label>
                        <div class="input-group">
                            <input type="text" name="email" value="{{session('email')}}" size="30" class="form-control" readonly> 
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="telefono">Telefono *</label>
                        <div class="input-group">
                            <input type="number" name="telefono" value="{{session('usu_telefono')}}" size="30" class="form-control" readonly >
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="autoriza">¿Autoriza el cambio de jornada? *</label>
                        <div class="input-group">
                            <select name="autoriza" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
                                <option value="si">Si
                                <option value="no">No
                            </select>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="asignatura">Asignatura *</label>
                        <div class="input-group">
                            <input type="text" name="asignatura" size="30" class="form-control" placeholder="Introduzca su asignatura" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="codigoA">Codigo Asignatura *</label>
                        <div class="input-group">
                            <input type="text" name="codigoA" size="30" class="form-control" placeholder="Introduzca el codigo de la asignatura" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="horas">Horas de clase semanales *</label>
                        <div class="input-group">
                            <input type="number" name="horas" size="30" class="form-control" placeholder="Introduzca las horas de clase semanales" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="creditos">Creditos de la Asignatura *</label>
                        <div class="input-group">
                            <input type="text" name="creditos" size="30" class="form-control" placeholder="Introduzca el numero de creditos de la asignatura" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="banco">Banco *</label>
                        <div class="input-group">
                            <input type="text" name="banco" size="30" class="form-control" placeholder="Introduzca el banco" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="cuenta">Numero de la Cuenta *</label>
                        <div class="input-group">
                            <input type="number" name="cuenta" size="30" class="form-control" placeholder="Introduzca el numero de cuenta" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="valor">Valor Pagado *</label>
                        <div class="input-group">
                            <input type="number" name="valor" size="30" class="form-control" placeholder="Introduzca el valor pagado" required>
                        </div>              
                    </div>

                    <div class="form-group">
                        <b>
                        <label class="control-label" for="imgRecibo">Seleccionar imagen con escaneo de pago </label>
                        
                        <p class="form-control-static">Si lo desea, puede adjuntar el recibo de pago para un trámite mas rápido.</p>
                    </b></b>

                        <input type="file" id="imgRecibo" name="imgRecibo" class="form-control-file" accept=".jpg, .jpeg, .png, .gif">
                                   
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="liquidacion">N° de la Liquidacion *</label>
                        <div class="input-group">
                            <input type="number" name="liquidacion" size="30" class="form-control" placeholder="Introduzca el numero de la liquidacion" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="dia">Fecha de solicitud *</label>
                        <div class="input-group">
                            <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly />
                        </div>              
                    </div>

                    <hr>

                    <p style="color: #BBD035;">
                        A continuación se generará un PDF con la información suministrada y se enviará un correo electronico a su bandeja de entrada desde donde podrá visualizar la solicitud creada en cualquier momento.
                    </p>

                    <br>

                    <input type="submit" value="Generar" class="btn btn-primary btn-enviar-sol">

                    {!!Form::close()!!}

                    <div id="contenedor-error-load">
                        <p><i><span class="badge badge-danger" id="span-tel">info</span> Porfavor, rellena todos los campos para continuar</i>&nbsp;&nbsp;&nbsp;<i class="far fa-hand-point-up fa-1x"></i></p>
                    </div>

                </div><!--/span-->

            </div><!--/row-->

        </div>

    </div>
    <!-- FIN DEL CONTENEDOR PARA FORMULARIO R-DC-52 -->

    <div id="oscurecer"></div>
        
    <div id="div-loading">
        <i class="fas fa-spinner fa-6x fa-spin"></i>
        <p id="letra-pequena-load">&nbsp;&nbsp;Cargando...</p>
    </div>

    <!-- FIN DEL CONTENEDOR PARA FORMULARIO R-DC-13 -->


    @section('javascript')
        @parent
        <script type="text/javascript" src="{{ URL::asset('js/script-cargando.js') }}"></script>
    @stop

@stop