@extends ('layouts.templateBasico')

@section('titulo') Gesol - Manuales de ayuda FAQ @stop

@section('contenido')
        <div class="container">
            <!--Jumbotron-->
            <div class="jumbotron">

                <h2 class="display-4">
                    <center>
                        Pagina de ayuda&nbsp;&nbsp; <i class="fa fa-ambulance fa-2x" aria-hidden="true"></i>
                    </center>
                </h2>

                <br>

                <p class="lead">
                    Bienvenido a la página de ayuda. Aquí encontrarás respuestas a preguntas frecuentes
                </p>

                <hr class="my-2">

                <p class="lead">
                    Si no logras resolver tu duda en particular, puedes comunicarte con nosotros dando clic en el siguiente botón.<br>
                    Trataremos de responderte lo mas pronto posible.
                </p>
                
                <center>
                    <a class="btn btn-primary btn-lg" href="contacto/create" role="button">Contactarse</a>
                </center>

                <br>
                
                <h2>Preguntas frecuentes</h2>

                <div id="accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">
                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="link-ayuda">
                              ¿Qué es GESOL?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                GESOL es una plataforma web, con la cual se logra que los estudiantes de nuestras coordinacion de sistemas de las unidades tecnológicas de santader puedan gestionar las diferentes solicitudes academicas sin tener la necesidad de dirigirse a la institucion.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingTwo">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="link-ayuda">
                            ¿Cómo hacer una solicitud?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                Para hacer un solicitud primero hay que estar registrado en GESOL (si no esta registrado <a href="/usuarios/create" id="link-ayuda">Clic aquí</a> para registrarse). Si ya tiene una cuenta, <a href="/redactarSolicitud" id="link-ayuda">Clic aquí</a> para hacer una solicitud.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingThree">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" id="link-ayuda">
                            ¿Este servico tiene algun costo?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                GESOL es una plataforma web para el beneficio de nuestros estudiantes, por lo tanto GESOL no tiene ningun costo.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingFour">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour" id="link-ayuda">
                            ¿En cuanto tiempo puedo tener una respuesta?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                El tiempo estimado de respuesta de una solicitud es de aproximado una semana dependiendo de las congestiones que tengan lugar en la coordinacion de sistemas de las Unidades Tecnológicas de Santander.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingFive">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive" id="link-ayuda">
                            ¿Qué tengo que hacer para que respondan?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                Las respuestas de las solicitudes serán automaticamente enviadas a su <a href="solicitudes/misSolicitudes/{{session('usu_cedula')}}" id="link-ayuda">su bandeja de entrada</a>, por lo tanto lo unico que debe hacer es esperar la respuesta.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingSix">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix" id="link-ayuda">
                            ¿Qué hago si no me satisface la respuesta?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                Puede dejar su reclamo en nuestra <a href="contacto/create" id="link-ayuda">pagina de contactos</a>, o si lo desea puede dirigirse directamente a la coordinacion de sistemas de las Unidades Tecnológicas de Santander .
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingSeven">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" id="link-ayuda">
                            ¿Qué hago en caso de olvidar mi cuenta o mi contraseña?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseSeven" class="collapse" role="tabpanel" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body">
                                Puede reestablecer su contraseña <a href="/resetPassword/reset" id="link-ayuda">aquí</a>.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingEight">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight" id="link-ayuda">
                            ¿Cómo puedo comunicarme con un administrador?
                            </a>
                            </h5>
                        </div>

                        <div id="collapseEight" class="collapse" role="tabpanel" aria-labelledby="headingEight" data-parent="#accordion">
                            <div class="card-body">
                                Para contactar con nuestros administradores da <a href="contacto/create" id="link-ayuda">Clic aquí</a>.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingNine">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine" id="link-ayuda">
                            Acuerdos de privacidad
                            </a>
                            </h5>
                        </div>

                        <div id="collapseNine" class="collapse" role="tabpanel" aria-labelledby="headingNine" data-parent="#accordion">
                            <div class="card-body">
                                El equipo GESOL, así; como los directivos y administradores de la coordinación a la cual los usuarios presenten solicitudes mediante la plataforma, se compromete a <strong>no divulgar información personal</strong> a terceros, entendiéndose ésta como los datos suministrados durante el proceso de registro, y consagrados en los documentos virtuales generados. Solo <strong>y exclusivamente</strong> podrán ser usados para los fines de: redacción de solicitudes, respuesta, y contacto; siendo dicha información gestionada por personal autorizado a travez del coordinador encargado de la dependencia.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingTen">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen" id="link-ayuda">
                            Acerca de
                            </a>
                            </h5>
                        </div>

                        <div id="collapseTen" class="collapse" role="tabpanel" aria-labelledby="headingTen" data-parent="#accordion">
                            <div class="card-body">
                                Este software fué desarrollado por el Tecnólogo Juan Emmanuel Martínez Gómez, como estudiante del Instituto Tecnológico Metropolitano - ITM. 
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="headingEleven">
                            <h5 class="mb-0">
                            <a class="collapsed" data-toggle="collapse" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven" id="link-ayuda">
                            Licencias de software
                            </a>
                            </h5>
                        </div>

                        <div id="collapseEleven" class="collapse" role="tabpanel" aria-labelledby="headingEleven" data-parent="#accordion">
                            <div class="card-body">
                                Para la construcción del software GESOL se implementaron los Frameworks de desarrollo Laravel 5, y Bootstrap 4, cuyas licencias de uso se pueden encontrar dando clic <a href="https://opensource.org/licenses/MIT" id="link-ayuda">en este enlace</a>, al igual que el plugin DataTables, cuyos términos se exponen en <a href="https://datatables.net/license/mit" id="link-ayuda">esta página</a>. 
                                <br>
                                Se les reconoce un agradecimiento sincero por su contribución a este proyecto, y a la cooperación obsequiada desinteresadamente a la comunidad mundial de desarrolladores. Muchas gracias.
                            </div>
                        </div>
                    </div>
                </div>           
            </div><!--/Termina jumbo-->
        </div>


@stop
