@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')

    <!-- CONTENEDOR PARA FORMULARIO R-DC-14 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    <h1 class="encabezado-solicitudes"><center><strong>Solicitud Revisión de Nota</strong></center></h1>

                    <br>

                    <hr class="linea-encabezado">
                    <br>

                    <h3 class="subencabezado">Ingresar Datos</h3>

                    {!!Form::open(['route' => ['solicitudes.store'], 'method'=>'POST'])!!}      

                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" value="R-DC-14" name="codSol" class="form-control">
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
                      <label class="control-label" for="direccion">Direccion *</label>
                        <div class="input-group">
                            <input type="text" name="direccion" size="30" class="form-control" placeholder="Introduzca su direccion" required> 
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="telefono">Telefono *</label>
                        <div class="input-group">
                            <input type="number" name="telefono" value="{{session('usu_telefono')}}" size="30" class="form-control" readonly >
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
                      <label class="control-label" for="periodo">Periodo Academico (Ejemplo) 2017-II *</label>
                        <div class="input-group">
                            <input type="text" name="periodo" size="30" class="form-control" placeholder="Introduzca su periodo academico" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="docente">Docente *</label>
                        <div class="input-group">
                            <input type="text" name="docente" size="30" class="form-control" placeholder="Introduzca el nombre del docente" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="motivo">Motivo *</label>
                        <div class="input-group">
                            <textarea name="motivo" rows="4" cols="50" maxlength="278" class="form-control" placeholder="Introduzca su motivo"></textarea>
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
    <!-- FIN DEL CONTENEDOR PARA FORMULARIO R-DC-14 -->

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