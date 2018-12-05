@extends('layouts.templateBasico')

@section('title') Gesol : Respuestas @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')

    <!-- CONTENEDOR RESPUESTA R-DC-14 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">
            
                    {!!Form::open(['route' => ['respuestas.store'], 'method'=>'POST'])!!}

                    <input type="hidden" value="{{$sol_nombre}}" name="sol_nombre" class="form-control">

                    <input type="hidden" value="{{$sol_formato}}" name="sol_formato" class="form-control">  

                    <input type="hidden" value="{{$sol_id}}" name="sol_id" class="form-control">
                        
                    <!--Si tiene rol de docente, puede editar los siguientes campos-->
                    @if(Session('rol_id') == 5)

                    <h1><center><strong>DOCENTE</strong></center></h1>

                    <br>

                    <div class="form-group">
                      <label class="control-label" for="apellidos">Apellidos *</label>
                        <div class="input-group">
                            <input type="text" name="apellidos" size="30" class="form-control" placeholder="Introduzca sus apellidos">
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="nombres">Nombres *</label>
                        <div class="input-group">
                            <input type="text" name="nombres" size="30" class="form-control" placeholder="Introduzca su nombre">
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="Codigo">Codigo del Docente *</label>
                        <div class="input-group">
                            <input type="number" name="Codigo" size="30" class="form-control" placeholder="Introduzca su codigo">
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Concepto">Concepto *</label>
                        <div class="input-group">
                            <textarea name="Concepto" size="30" maxlength="275" rows="7" cols="50" class="form-control" placeholder="Introduzca un concepto"></textarea>
                        </div>              
                    </div>

                    <label class="control-label"><strong>Notas:</strong></label>

                    <div class="form-group">
                        <label class="control-label" for="Corte1">Primer Corte *</label>
                        <div class="input-group">
                            <input type="number" name="Corte1" size="30" step="0.01" class="form-control" placeholder="Introduzca nota del primer corte" required> 
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Corte2">Segundo Corte *</label>
                        <div class="input-group">
                            <input type="number" name="Corte2" size="30" step="0.01" class="form-control" placeholder="Introduzca nota del segundo corte" required> 
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Corte3">Tercer Corte *</label>
                        <div class="input-group">
                            <input type="number" name="Corte3" size="30" step="0.01" class="form-control" placeholder="Introduzca nota del tercer corte" required> 
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Habilitacion">Habilitacion *</label>
                        <div class="input-group">
                            <input type="number" name="Habilitacion" size="30" step="0.01" class="form-control" placeholder="Introduzca nota de la habilitacion" required> 
                        </div>              
                    </div>

                    <label class="control-label"><strong>Nota Definitiva:</strong></label>

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
                        <label class="control-label" for="dia">Fecha de solicitud *</label>
                        <div class="input-group">
                            <select name="dia" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option value="01">01</option> 
                                <option value="02">02</option> 
                                <option value="04">04</option>
                                <option value="05">05</option> 
                                <option value="06">06</option> 
                                <option value="07">07</option>
                                <option value="08">08</option> 
                                <option value="09">09</option> 
                                <option value="10">10</option> 
                                <option value="11">11</option> 
                                <option value="12">12</option> 
                                <option value="13">13</option>
                                <option value="14">14</option> 
                                <option value="15">15</option> 
                                <option value="16">16</option> 
                                <option value="17">17</option> 
                                <option value="18">18</option> 
                                <option value="19">19</option> 
                                <option value="20">20</option> 
                                <option value="21">21</option> 
                                <option value="22">22</option> 
                                <option value="23">23</option> 
                                <option value="24">24</option> 
                                <option value="25">25</option> 
                                <option value="26">26</option> 
                                <option value="27">27</option> 
                                <option value="28">28</option> 
                                <option value="29">29</option> 
                                <option value="30">30</option> 
                                <option value="31">31</option>   
                            </select>
                            <h2 class="mx-1">/</h2>
                            <select name="mes" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option value="01">Enero</option> 
                                <option value="02">Febrero</option> 
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option> 
                                <option value="05">Mayo</option> 
                                <option value="06">Junio</option>
                                <option value="07">Julio</option> 
                                <option value="08">Agosto</option> 
                                <option value="09">Septiembre</option> 
                                <option value="10">Octubre</option> 
                                <option value="11">Noviembre</option> 
                                <option value="12">Diciembre</option> 
                            </select>
                            <h2 class="mx-1">/</h2>
                            <select name="año" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option value="2017">2017</option> 
                                <option value="2018">2018</option>
                            </select> 
                        </div>              
                    </div>

                    @endif

                    <!--Si tiene rol de coordinador, puede editar los siguientes campos-->
                    @if(Session('rol_id') == 3)

                    <h1><center><strong>COORDINADOR</strong></center></h1>

                    <br>

                    <div class="form-group">
                        <label class="control-label" for="Concepto2">Observaciones *</label>
                        <div class="input-group">
                            <textarea name="Observaciones" size="30" maxlength="190" rows="7" cols="50" class="form-control" placeholder="Introduzca una observacion"></textarea>
                        </div>              
                    </div>

                    @endif

                    <br>
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
    <!-- FIN DEL CONTENEDOR RESPUESTA R-DC-14 -->

@stop
