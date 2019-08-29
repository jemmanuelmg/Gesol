@extends('layouts.templateBasico')

@section('title') Gesol : Solicitudes @stop

@section('contenido')

    @include('notificaciones.mostrarErrorForm')
    
    <!-- CONTENEDOR PARA FORMULARIO R-DC-40 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">

                    <h1 class="encabezado-solicitudes"><center><strong>Carta Autorización para Modalidad Proyecto de Grado ITM</strong></center></h1>

                    <br>
                    <hr class="linea-encabezado">
                    <br>

                    <h3 class="subencabezado">Ingresar datos</h3>

                    {!!Form::open(['route' => ['solicitudes.store'],'files' => true, 'method'=>'POST'])!!}      

                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" value="R-ITM-01" name="codSol" class="form-control">
                        </div>              
                    </div>

                    
                    
                    <!--FIN ROW-->
                    <div class="row">
                        <!--COMIENZO PRIMERA COLUMNA-->
                        <div class="col-md-6">

                            <div class="form-group">
                              <label class="control-label" for="apellidos">Asunto *</label>
                                <div class="input-group">
                                    <input type="text" name="asunto" placeholder="Introduzca el asunto de la carta" size="30" class="form-control" required>
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="apellidos">Departamento *</label>
                                <div class="input-group">
                                    <input type="text" name="departamento" placeholder="Introduzca su departamento" size="30" class="form-control" required>
                                </div>              
                            </div>




                            <div class="form-group">
                              <label class="control-label" for="nombres">Nombres *</label>
                                <div class="input-group">
                                    <input type="text" name="nombres" value="{{session('usu_nombres')}}" size="30" class="form-control" readonly > 
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="apellidos">Apellidos *</label>
                                <div class="input-group">
                                    <input type="text" name="apellidos" value="{{session('usu_apellidos')}}" size="30" class="form-control" readonly >
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="carne">Número de carné *</label>
                                <div class="input-group">
                                    <input type="number" name="carne" placeholder="Introduzca el número de su carné académico"  size="30" class="form-control" required> 
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="cedula">Documento de Identidad *</label>
                                <div class="input-group">
                                    <input type="number" name="cedula" value="{{session('usu_cedula')}}" size="30" class="form-control" readonly > 
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="lugar">Lugar de expedición *</label>
                                <div class="input-group">
                                    <input type="text" name="lugar" maxlength="21" placeholder="Departamento y municipio donde obtuvo su identificación" size="30" class="form-control" required > 
                                </div>              
                            </div>

                        </div>
                        <!--FIN PRIMERA COLUMNA-->

                        <!--COMIENZO SEGUNDA COLUMNA-->
                        <div class="col-md-6">

                            <div class="form-group">
                              <label class="control-label" for="fijo">Número teléfono fijo</label>
                                <div class="input-group">
                                    <input type="number" name="fijo" placeholder="Introduzca número de teléfono fijo"  size="30" class="form-control" > 
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="celular">Número teléfono celular *</label>
                                <div class="input-group">
                                    <input type="number" name="celular" value="{{session('usu_telefono')}}" placeholder="Introduzca número de teléfono celular" size="30" class="form-control" required> 
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="email1">Correo institucional *</label>
                                <div class="input-group">
                                    <input type="text" name="email1" placeholder="Introduzca su e-mail institucional" size="30" class="form-control" required > 
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="email2">Correo personal *</label>
                                <div class="input-group">
                                    <input type="text" name="email2" value="{{session('email')}}" placeholder="Introduzca su e-mail de uso personal" size="30" class="form-control" required > 
                                </div>              
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="programa">Modalidad deseada*</label>
                                <div class="texto-azul">Porfavor seleccione la modalidad de proyecto de grado a la que aspira.</div>
                                <select name='modalidad' class="custom-select" id="selector-sol-dropdown">
                                        <option>Seleccione una solicitud</option>
                                        <option value="1">Proyecto de Grado</option>
                                        <option value="2">Prácticas Profesionales</option>
                                        <option value="3">Curso de Posgrado</option>
                                        <option value="4">Práctica en taller o Laboratorio</option>
                                        <option value="5">Pasantía</option>
                                        <option value="6">Certificación</option>
                                        <option value="7">Emprendimiento</option>
                                        <option value="8">Producto de Investigación</option>
                                        <option value="9">Reconocimiento Laboral</option>
                                        <option value="10">Ingeniería Para la Gente</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label class="control-label" for="programa">Programa académico *</label>
                                <div class="input-group">
                                    <input type="text" name="programa" placeholder="Introduzca el nombre de su programa académico actual" size="30" class="form-control" required>
                                </div>              
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="tipoPrograma">Tipo de programa académico *</label>
                                <br>
                                <input type="radio" name="tipoPrograma" value="1"> Tecnología &nbsp;&nbsp;
                                <input type="radio" name="tipoPrograma" value="2"> Ingeniería

                            </div>

                            <div class="form-group">
                              <label class="control-label" for="dia">Fecha de solicitud *</label>
                                <div class="input-group">
                                    <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly />
                                </div>              
                            </div>

                        </div>
                        <!--FIN SEGUNDA COLUMNA-->

                    </div>
                    <!--FIN ROW-->

                    
                    <br>
                    <hr>
                    <p class="texto-azul">
                        <b>Documentos Anexos</b>
                    </p>   

                    <div>
                        <p>Si lo desea puede adjuntar un documento en formato pdf con información adicional que respalde sus solicitud</p>
                        <input type="file" name="adjunto1" class="form-control-file" accept=".pdf">
                    </div>





                    <br>
                    <hr>
                    <p class="texto-azul">
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
