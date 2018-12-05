@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')

    <!-- CONTENEDOR PARA FORMULARIO R-DC-14 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    <h1><center><strong>SOLICITUD REVISIÓN DE NOTA</strong></center></h1>

                    <br>

                    <h2><strong>Ingresar Datos</strong></h2>

                    {!!Form::open(['route' => ['solicitudes.store'], 'method'=>'POST'])!!}      

                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" value="R-DC-14" name="codSol" class="form-control">
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="apellidos">Apellidos *</label>
                        <div class="input-group">
                            <input type="text" name="apellidos" size="30" class="form-control" placeholder="Introduzca sus Apellidos" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="nombres">Nombres *</label>
                        <div class="input-group">
                            <input type="text" name="nombres" size="30" class="form-control" placeholder="Introduzca su nombre" required> 
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="cedula">Documento de Identificacion *</label>
                        <div class="input-group">
                            <input type="number" name="cedula" size="30" class="form-control" placeholder="Introduzca su identificacion" required> 
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="programa">Programa Academico *</label>
                        <div class="input-group">
                            <select name="programa" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
                                <option value="Desarrollo de sistemas informaticos">Desarrollo de sistemas informaticos</option>
                                <option value="Deportiva">Tecnologia en Deportes</option>
                            </select>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="jornada">Jornada *</label>
                        <div class="input-group">
                            <select name="jornada" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
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
                            <input type="number" name="telefono" size="30" class="form-control" placeholder="Introduzca su telefono" required> 
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
                            <textarea name="motivo" rows="4" cols="50" class="form-control" placeholder="Introduzca su motivo"></textarea>
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

                    <hr>

                    <p style="color: #BBD035;">
                        A continuación se generará un PDF con la información suministrada y se enviará un correo electronico a su bandeja de entrada desde donde podrá visualizar la solicitud creada en cualquier momento.
                    </p>

                    <br>

                    <input type="submit" value="Generar" class="btn btn-primary btn-lg">

                    {!!Form::close()!!}

                </div><!--/span-->

            </div><!--/row-->

        </div>

    </div>
    <!-- FIN DEL CONTENEDOR PARA FORMULARIO R-DC-14 -->
            
@stop