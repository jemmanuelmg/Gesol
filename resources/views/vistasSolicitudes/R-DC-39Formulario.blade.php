@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')

    <!-- CONTENEDOR PARA FORMULARIO R-DC-14 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    <h1 class="encabezado-solicitudes"><center><strong>Modificación de la Matrícula Académica</strong></center></h1>

                    <br>

                    <hr class="linea-encabezado">

                    <br>

                    <h3 class="subencabezado">Ingresar Datos</h3>

                    {!!Form::open(['route' => ['solicitudes.store'], 'method'=>'POST'])!!}      

                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" value="R-DC-39" name="codSol" class="form-control">
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
                      <label class="control-label" for="semestre">Semestre *</label>
                        <div class="input-group">
                            <input type="number" name="semestre" size="30" class="form-control" placeholder="Introduzca su semestre" required> 
                        </div>              
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
                      <label class="control-label" for="e-mail">Correo Electronico *</label>
                        <div class="input-group">
                            <input type="email" name="e-mail" value="{{session('email')}}" size="30" class="form-control" readonly> 
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="telefono">Telefono *</label>
                        <div class="input-group">
                            <input type="number" name="telefono" value="{{session('usu_telefono')}}" size="30" class="form-control" readonly >
                        </div>              
                    </div>

                    <br>
                    <br>

                    <div class="form-group">
                      <label class="control-label" for="modificacion">Tipo de Modificación *</label>
                        <div class="input-group">
                            <select name="modificacion" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
                                <option value="Cancelacion">Cancelacion de semestre</option>
                                <option value="Aplazamiento">Aplazamiento de semenstre</option>
                                <option value="CambioJornada">Cambio de jornada</option>
                                <option value="Readmision">Readmisión</option>
                                <option value="Transferencia">Transferencia Interna</option>
                            </select>
                        </div>              
                    </div>

                    <p style="color: #BBD035;">
                        Dependiendo de la seleccion previa, complete solo los campos que necesite.
                    </p>

                    <hr>

                    <div class="form-group">
                      <label class="control-label" for="programa2">Programa al que aspira *</label>
                        <div class="input-group">
                            <input type="text" name="programa2" size="30" class="form-control" placeholder="Introduzca el programa al que aspira">
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="jornada2">Jornada *</label>
                        <div class="input-group">
                            <select name="jornada2" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
                                <option value="Nocturna">Nocturna</option>
                                <option value="Diurna">Diurna</option>
                            </select>
                        </div>              
                    </div>

                    <br>
                    <hr>
                    <br>

                    <div class="form-group">
                      <label class="control-label" for="Asignaturas">Inclusion o cancelacion de asignaturas *</label>
                        <div class="input-group">
                            <select name="Asignaturas" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
                                <option value="Inclusion">Inclusión de Asignatura</option>
                                <option value="Cancelacion">Cancelación de Asignatura</option>
                            </select>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="NombreA">Asignatura *</label>
                        <div class="input-group">
                            <input type="text" name="NombreA" size="30" class="form-control" placeholder="Introduzca el nombre de la asignatura">
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="CodigoA">Codigo Asignatura *</label>
                        <div class="input-group">
                            <input type="text" name="CodigoA" size="30" class="form-control" placeholder="Introduzca el codigo de la asignatura">
                        </div>              
                    </div>

                    <br>
                    <hr>
                    <br>

                    <div class="form-group">
                      <label class="control-label" for="motivo">Observaciones *</label>
                        <div class="input-group">
                            <textarea name="Observaciones" rows="4" cols="50" maxlength="112" class="form-control" placeholder="Introduzca una observacion"></textarea>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="modificacion2">Motivo de la modificacion *</label>
                        <div class="input-group">
                            <select name="modificacion2" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
                                <option value="DificultadAcademica">Dificultad Académica</option>
                                <option value="Traslado">Traslado a otra institución</option>
                                <option value="Bajorendimiento">Bajo rendimiento académico</option>
                                <option value="Dificultades">Dificultades de adaptación institucional</option>
                                <option value="Cambio">Cambio de ciudad</option>
                                <option value="Dificultadesfamiliares">Dificultades familiares</option>
                                <option value="Ubicacionlaboral">Ubicacion laboral</option>
                                <option value="Eleccionequivocada">Eleccion equivocada de carrera</option>
                                <option value="Enfermedad">Enfermedad</option>
                                <option value="Economicos">Economicos</option>
                                <option value="Otra">Otra...</option>
                            </select>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="otroMotivo">¿Otro motivo? *</label>
                        <div class="input-group">
                            <input type="text" name="otroMotivo" size="30" maxlength="95" class="form-control" placeholder="Introduzca otro motivo, maximo 95 caracteres">
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
        <!--<script type="text/javascript" src="{{ URL::asset('js/script-cargando.js') }}"></script>-->
    @stop
            
@stop
