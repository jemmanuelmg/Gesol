@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm') 

    <!-- CONTENEDOR PARA FORMULARIO R-DC-13 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    <h1 class="encabezado-solicitudes"><b><center>Autorización Examen de Autouficiencia</center><b></h1>
                    <br>    
                    <hr class="linea-encabezado">

                    <br>

                    <h3 class="subencabezado">Ingresar Datos</h3>
                    
                    {!!Form::open(['route' => ['solicitudes.store'],'files' => true, 'method'=>'POST'])!!}      

                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" value="R-DC-13" name="codSol" class="form-control">
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
                            <select name="jornada" id="probando" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                <option>Seleccione</option>
                                <option value="Nocturna">Nocturna</option>
                                <option value="Diurna">Diurna</option>
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
                      <label class="control-label" for="dia">Fecha de solicitud *</label>
                        <div class="input-group">
                            <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly />
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="consignacion">Nro. Consignación *</label>
                        <div class="input-group">
                            <input type="text" name="consignacion" size="30" class="form-control" placeholder="Introduzca el Nro de consignacion" required>
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="telefono">Telefono *</label>
                        <div class="input-group">
                            <input type="number" name="telefono" value="{{session('usu_cedula')}}" size="30" class="form-control" readonly >
                        </div>              
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="imgRecibo">Seleccionar imagen con escaneo de pago </label>
                        
                        <p class="form-control-static">Si lo desea, puede adjuntar el recibo de pago para un trámite mas rápido.</p>

                        <input type="file" id="imgRecibo" name="imgRecibo" class="form-control-file" accept=".jpg, .jpeg, .png, .gif">
                        

                                    
                    </div>

                    <hr>

                    <p style="color: #BBD035;">
                        A continuación se generará un PDF con la información suministrada y se enviará un correo electronico a su bandeja de entrada desde donde podrá visualizar la solicitud creada en cualquier momento.
                    </p>

                    <br>

                    <input class="btn btn-primary btn-enviar-sol" type="submit" value="Generar">

                    {!!Form::close()!!}

                    <button class="btn btn-primary btn-enviar-sol">Hola!</button>
                    <div class="container">@include('partials.loading')</div>
                    

                </div><!--/span-->

            </div><!--/row-->

        </div>

    </div>

    <!-- FIN DEL CONTENEDOR PARA FORMULARIO R-DC-13 -->
    
    
