@extends('layouts.templateBasico')

@section('title') Gesol : Respuestas @stop

@section('contenido')
    
    @include('notificaciones.mostrarErrorForm')

    <!-- CONTENEDOR RESPUESTA R-DC-39 -->
    <div class="container">

        <div class="jumbotron">

            <div class="row">

                <div class="col-md-12">
            
                    {!!Form::open(['route' => ['respuestas.store'], 'method'=>'POST'])!!}

                    <input type="hidden" value="{{$sol_nombre}}" name="sol_nombre" class="form-control">

                    <input type="hidden" value="{{$sol_formato}}" name="sol_formato" class="form-control">  

                    <input type="hidden" value="{{$sol_id}}" name="sol_id" class="form-control">

                    <h1><center><strong>Coordinador</strong></center></h1>

                    <br>

                    <div class="form-group">
                        <label class="control-label" for="Concepto">Concepto *</label>
                        <div class="input-group">
                            <textarea name="Concepto" size="30" maxlength="190" rows="7" cols="50" required class="form-control" placeholder="Introduzca un concepto"></textarea>
                        </div>              
                    </div>

                    <label class="control-label"><strong>Promedio Acumulado:</strong></label>

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
                            <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly/>
                        </div>              
                    </div>

                    <hr>

                    <p style="color: #BBD035;">
                        <b>Atecion:</b><br>
                        Al dar clic en el botón 'Responder' se actualizará la solicitud en la base de datos, cambiado su estado a 'Atendida' automáticamente.
                    </p>

                    <br>

                    <input type="submit" value="Responder" class="btn btn-primary btn-lg">

                    {!!Form::close()!!}

                </div> <!--/span-->

            </div> <!--/row-->

        </div> <!--/jumbotron-->

    </div>
    <!-- FIN DEL CONTENEDOR RESPUESTA R-DC-39 -->
            
@stop
