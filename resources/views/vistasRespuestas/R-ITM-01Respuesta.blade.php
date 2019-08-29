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

                    <h1><center><strong>Redactar respuesta</strong></center></h1>

                    <br>

                    <div class="form-group">
                        <label class="control-label" for="Concepto">Texto de la respuesta*</label>
                        <p class="texto-gris">
                            Porfavor escriba el texto que contendrá la respuesta enviada al estudiante. 
                            En él se puede explicar si se accede o no a la petición en un máximo de 377 caracteres.
                        </p>
                        <div class="input-group">
                            <textarea name="texto" maxlength="2737" rows="15" cols="50" required class="form-control" placeholder="Introduzca el texto de la respuesta"></textarea>
                        </div>              
                    </div>

                    <div class="form-group">
                              <label class="control-label" for="programa">Concepto </label>
                                <select name='concepto' class="custom-select" id="selector-sol-dropdown">
                                        <option value="Favorable">Favorable</option>
                                        <option value="Desfavorable">Desfavorable</option>
                                </select>
                            </div>

                    <div class="form-group">
                      <label class="control-label" for="dia">Fecha de respuesta *</label>
                        <div class="input-group">
                            <input name="fechaSol" type="date" value="{{date('Y-m-d')}}" class="form-control" readonly/>
                        </div>              
                    </div>

                    <hr>

                    <p class="texto-azul">
                        <b>Atecion:</b><br>
                        Al dar clic en el botón 'Responder' se actualizará la solicitud en la base de datos cambiado su estado a 'Atendida' automáticamente.
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
