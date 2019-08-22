@extends('layouts.templateBasico')

@section('title') Gesol : Respuestas @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')

    <!-- CONTENEDOR RESPUESTA R-DC-13 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    {!!Form::open(['route' => ['respuestas.store'], 'method'=>'POST'])!!}

                    <input type="hidden" value="{{$sol_nombre}}" name="sol_nombre" class="form-control">             
                    <input type="hidden" value="{{$sol_formato}}" name="sol_formato" class="form-control">            
                    <input type="hidden" value="{{$sol_id}}" name="sol_id" class="form-control">
                        
                    <!--Si tiene rol de decano, puede editar los siguientes campos-->
                    @if(session('rol_id') == 4)

                    <h1><center><strong>Decano</strong></center></h1>

                    <br>

                    <label class="control-label"><strong>Docentes asignados para la realizacion del examen de autosuficiencia.</strong></label>

                    <br>

                    <div class="form-group">
                      <label class="control-label" for="Docente1">Docente 1 *</label>
                        <div class="input-group">
                            <input type="text" name="Docente1" size="30" class="form-control" placeholder="Introduzca el nombre del primer docente" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="Docente2">Docente 2 *</label>
                        <div class="input-group">
                            <input type="text" name="Docente2" size="30" class="form-control" placeholder="Introduzca el nombre del segundo docente" required/>
                        </div>              
                    </div>

                        <div class="form-group">
                        <label class="control-label" for="dia">Fecha de respuesta *</label>
                        <div class="input-group">
                            <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly />
                        </div>              
                        </div>
                                 
                    </div>

                    @endif

                    <!--Si tiene rol de docente, puede editar los siguientes campos-->
                    @if(session('rol_id') == 5)

                    <h1><center><strong>Docente</strong></center></h1>

                    <br>

                    <div class="form-group">
                      <label class="control-label" for="Concepto">Observaciones *</label>
                        <div class="input-group">
                            <textarea name="Concepto" size="30" maxlength="175" rows="7" cols="50" class="form-control" placeholder="Introduzca una observacion"></textarea>
                        </div>              
                    </div>

                    <label class="control-label"><strong>Nota:</strong></label>

                    <div class="form-group">
                      <label class="control-label" for="Numero">Numero *</label>
                        <div class="input-group">
                            <input type="number" name="Numero" size="30" step="0.01" class="form-control" placeholder="Introduzca el numero de la nota" required> 
                        </div>              
                    </div> 

                    <div class="form-group">
                      <label class="control-label" for="Letras">Letras *</label>
                        <div class="input-group">
                            <input type="text" name="Letras" size="30" class="form-control" placeholder="Introduzca las letras de la nota" required> 
                        </div>              
                    </div>

                    <div class="form-group">
                    <label class="control-label" for="dia">Fecha de respuesta *</label>
                    <div class="input-group">
                        <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly />
                    </div>              
                    </div>

                    @endif

                    <!--Si tiene rol de coordinador, puede editar los siguientes campos-->
                    @if(session('rol_id') == 3 || session('rol_id') == 2)

                    <h1><center><strong>Redactar respuesta</strong></center></h1>

                    <br>

                    <div class="form-group">
                      <label class="control-label" for="Concepto2">Observaciones *</label>
                        <div class="input-group">
                            <textarea name="Concepto2" size="30" maxlength="175" rows="7" cols="50" class="form-control" placeholder="Introduzca una observacion"></textarea>
                        </div>              
                    </div>

                    <div class="form-group">
                    <label class="control-label" for="dia">Fecha de respuesta *</label>
                    <div class="input-group">
                        <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly />
                    </div>              
                    </div>

                    @endif

                    <hr>
                    <br>

                    <fieldset class="form-group row">
                        <legend class="col-form-legend col-sm-12">
                            <strong>¿Desea marcar esta solicitud como totalmente atentida?</strong>
                        </legend>
                        <div class="col-sm-10">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="atendida" value="si">
                                <strong>Si</strong>
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="atendida" value="no" checked>
                                <strong>No</strong>
                              </label>
                            </div>
                      </div>
                    </fieldset>

                    <br>
                    <hr>

                    <p style="color: #BBD035;">
                        Para determinar si debería o no marcar la solicitud como atentida, lea el formato antes de responderlo, para saber si solo faltan sus anotaciones o aún quedan otros usuarios por escribir en él.
                    </p>

                    <br>

                    <input type="submit" value="Responder" class="btn btn-primary btn-lg">

                    {!!Form::close()!!}

                </div> <!--/span-->

            </div> <!--/row-->

        </div> <!--/jumbotron-->

    </div>
    <!-- FIN DEL CONTENEDOR RESPUESTA R-DC-13 -->
    
@stop
