@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')
    
    <!-- CONTENEDOR PARA FORMULARIO R-DC-40 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    <h1 class="encabezado-solicitudes"><center></center><strong>Solicitud de transferencia externa</strong></center></h1>

                    <br>
                    <hr class="linea-encabezado">
                    <br>

                    <h3 class="subencabezado">Ingresar Datos</h3>

                    {!!Form::open(['route' => ['solicitudes.store'],'files' => true, 'method'=>'POST'])!!}      

                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" value="R-DC-40" name="codSol" class="form-control">
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
                                <option value="Seleccione">Seleccione</option>
                                <option value="Desarrollo de sistemas informaticos">Desarrollo de sistemas informaticos</option>
                                <option value="Deportiva">Tecnologia en Deportes</option>
                            </select>
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
                      <label class="control-label" for="consignacion">Numero de Consignacion *</label>
                        <div class="input-group">
                            <input type="number" name="consignacion" size="30" class="form-control" placeholder="Introduzca su consignacion" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="entidad">Entidad Bancaria *</label>
                        <div class="input-group">
                            <input type="text" name="entidad" size="30" class="form-control" placeholder="Introduzca la entidad" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="valor">Valor Consignacion *</label>
                        <div class="input-group">
                            <input type="number" name="valor" size="30" class="form-control" placeholder="Introduzca el valor de la consignacion" required>
                        </div>              
                    </div>

                    <div class="form-group">
                      <label class="control-label" for="Educativa">Entidad Educatica *</label>
                        <div class="input-group">
                            <input type="text" name="Educativa" size="30" class="form-control" placeholder="Introduzca la entidad educativa" required>
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
                            <input type="number" name="telefono" value="{{session('usu_cedula')}}" size="30" class="form-control" readonly >
                        </div>              
                    </div>

                    <br>
                    <hr>
                    <br>

                    <p style="color: #BBD035;">
                        Documentos Anexos
                    </p>

                    <br>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="col-md-3">
                                <label class="control-label" for="estudios">
                                    <input type="checkbox" name="estudios" aria-label="form-check-input">
                                    Centificados de estudios
                                </label>
                            </div>

                            <label class="control-label mx-2" for="folios">Numero de Folios *</label>
                            
                            <input type="number" name="folios" size="30" class="form-control" placeholder="Introduzca el numero de folios" required>
                        </div>              
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="col-md-3">
                                <label class="control-label" for="tematicos">
                                    <input type="checkbox" name="tematicos" aria-label="form-check-input">
                                    Contenidos Tematicos
                                </label>
                            </div>
                            
                            <label class="control-label mx-2" for="folios2">Numero de Folios *</label>
                            
                            <input type="number" name="folios2" size="30" class="form-control" placeholder="Introduzca el numero de folios" required>                                    
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="imgRecibo"><b>Seleccionar imagen con escaneo de pago</b> </label>
                        
                        <p class="form-control-static">Si lo desea, puede adjuntar el recibo de pago para un trámite mas rápido.</p>

                        <input type="file" id="imgRecibo" name="imgRecibo" class="form-control-file" accept=".jpg, .jpeg, .png, .gif">
                                    
                    </div>

                    <br>

                    <div class="form-group">
                      <label class="control-label" for="dia">Fecha de solicitud *</label>
                        <div class="input-group">
                            <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly />
                        </div>              
                    </div>


                    <hr>

                    <p style="color: #BBD035;">
                        A continuación se generará un PDF con la información suministrada y se enviará un correo electronico a su bandeja de entrada desde donde podrá visualizar la solicitud creada en cualquier mome nto.
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
    <!-- FIN DEL CONTENEDOR PARA FORMULARIO R-DC-40 -->  

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
