@extends('layouts.form')
@section('form-body')
<div class="container-fluid text-center superiorBar">
    <img style="width:14rem" src="views/resources/images/cun-40.png" alt="logo_cun" />
</div>
<div class="container">
    <div class="row justify-content-center">
        <input type="hidden" name="usuario_id" id="usuario_id" value="111444">
        <div class="col-md-12 mt-5">
            <p style="text-align: justify;" class="text-white"> Completa la inscripción para tu primer semestre modalidad
                virtual desde nuestra plataforma y <strong>obtén un 10% de descuento</strong> en el pago de tu matrícula. ¡<strong>Empieza ya!</strong></p>
            <p style="font-size:13px;" class="text-secondary text-center mt-2">
                De continuar con el proceso, acepta los Términos y Condiciones y las Política de Privacidad de la CUN.
            </p>
        </div>
        <div class="col-lg-11 col-md-11 col-sm-11 columnaContainer mt-4">
            <!--stepper-->
            <div class="container mt-4 mb-2">
                <div class="stepper-container">
                    <div class="stepper-wrapper">
                        <div class="stepper-item active">
                            <div class="step-counter">1</div>
                            <div class="step-name">Contacto</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">2</div>
                            <div class="step-name">Nombre</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">3</div>
                            <div class="step-name">Identificación</div>
                        </div>
                        <div class="stepper-item">
                            <div class="step-counter">4</div>
                            <div class="step-name">Pago</div>
                        </div>
                    </div>
                </div>

                <!-- Contenido de los pasos -->
                <div id="step-1" class="step active">
                    <h2 class="mt-4 mb-4">Dinos cómo contactarte</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="celular" class="mb-2">Celular</label>
                            <input class="form-control form-control-sm input-sm" type="text" id="celular" placeholder="3124567890">
                            <label class=" errLabel" for="celular" id="errCelular"></label>
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="mb-2">Correo</label>
                            <input class="form-control form-control-sm input-sm" type="email" id="correo" placeholder="example@email.com">
                            <label class=" errLabel" for="correo" id="errCorreo"></label>
                        </div>
                    </div>
                    <div class="btn-container">
                        <button style="background-color: #8fca00; font-weight: 500;" class="btn text-dark" onclick="nextStep(2)">Guardar y continuar</button>
                    </div>
                </div>

                <div id="step-2" class="step">
                    <h2 class="mt-4 mb-4">Danos tu nombre</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="primerApellido" class="mb-2">Primer apellido</label>
                            <input class="form-control form-control-sm input-sm" type="text" id="primerApellido" placeholder="Primer apellido">
                            <label class=" errLabel" for="primerApellido" id="errPrimerApellido"></label>
                        </div>
                        <div class="col-md-6">
                            <label for="segundoApellido" class="mb-2">Segundo apellido</label>
                            <input class="form-control form-control-sm input-sm" type="text" id="segundoApellido" placeholder="Segundo apellido">
                            <label class=" errLabel" for="segundoApellido" id="errSegundoApellido"></label>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="primerNombre" class="mb-2">Primer nombre</label>
                            <input class="form-control form-control-sm input-sm" type="text" id="primerNombre" placeholder="Primer nombre">
                            <label class=" errLabel" for="primerNombre" id="errPrimerNombre"></label>
                        </div>
                        <div class="col-md-6">
                            <label for="segundoNombre" class="mb-2">Segundo Nombre</label>
                            <input class="form-control form-control-sm input-sm" type="text" id="segundoNombre" placeholder="Segundo Nombre">
                            <label class=" errLabel" for="segundoNombre" id="errSegundoNombre"></label>
                        </div>
                    </div>
                    <div class="btn-container">
                        <button class="btn btn-secondary" onclick="prevStep(1)">Regresar</button>
                        <button style="background-color: #8fca00; font-weight: 500;" class="btn text-dark" onclick="nextStep(3)">Guardar y continuar</button>
                    </div>
                </div>

                <div id="step-3" class="step">
                    <h2 class="mt-4 mb-4">Verifica tu identidad</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="tipoDocumento" class="mb-2">Tipo de documento</label>
                            <select class="form-select form-select-sm" id="tipoDocumento">
                                <option selected value="default">Tipo de documento</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tipoDocumento" class="mb-2">Nro. de documento</label>
                            <div class="input-group ">
                                <input class="form-control form-control-sm input-sm" type="text" id="documento" placeholder="(Sin puntos ni comas)">
                                <div class="input-group-append">
                                    <button id="buttonCheckNames" type="button" class="btn btn-sm btn-light input-group-text" onclick="apiNames()">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="fechaExpedicion" class="mb-2">Expedición del documento</label>
                            <input class="form-control form-control-sm input-sm" type="date" id="fechaExpedicion" />
                            <label class=" errLabel" for="fechaExpedicion" id="errFechaExpedicion"></label>
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="mb-2">Genero</label>
                            <select class="form-select form-select-sm" id="genero">
                                <option selected value="default">Selecciona</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                            <label class=" errLabel" for="genero" id="errGenero"></label>
                        </div>
                        <div class="col-md-6">
                            <label for="fechaNacimiento" class="mb-2">Fecha de nacimiento</label>
                            <input class="form-control form-control-sm input-sm " type="date" id="fechaNacimiento" />
                            <label class=" errLabel" for="fechaNacimiento" id="errFechaNacimiento"></label>
                        </div>

                        <div class="btn-container">
                            <button class="btn btn-secondary" onclick="prevStep(2)">Regresar</button>
                            <button style="background-color: #8fca00; font-weight: 500;" class="btn text-dark" onclick="nextStep(4)">Guardar y continuar</button>
                        </div>
                    </div>
                </div>
                <div id="step-4" class="step">
                    <h2 class="mt-4 mb-4">Elige tu programa académico y paga con descuento</h2>
                    <div class="col-md-12">
                        <label for="programa" class="mb-2">Programa académico (Modalidad Virtual)</label>
                        <select class="form-select form-select-sm " id="programa">
                            <option value="default" selected disabled>Programa académico</option>
                        </select>
                        <label class=" errLabel" for="programa" id="errPrograma"></label>
                    </div>

                    <div class="btn-container">
                        <button class="btn btn-secondary" onclick="prevStep(3)">Regresar</button>
                        <!--<button class="btn btn-success">Finalizar</button>-->
                    </div>
                </div>
            </div>
            <!--/steeper-->
            <!--oldform-->
            <form autocomplete="true">
                <div class="row">
                    <!-- tipo de documento -->

                    <!-- documento de identidad -->

                    <!--fecha de expedicion de documento-->

                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <!-- genero -->

                    </div>
                    <!--fecha de nacimiento-->

                    <!-- telefono fijo -->
                    <!-- celular -->

                </div>
                <div class="row">
                    <!-- correo -->
                    <!-- programa academico -->

                    <input type="hidden" id="valorMatricula">
                    <!--
                  <div class="col-md-6 col-lg-6 col-sm-6">
                    <select class="form-select form-select-sm " id="valorMatricula">
                      <option selected value="default">Valor matricula - idiomas - servicio médico</option>
                    </select>
                    <label class=" errLabel" for="valorMatricula" id="errValorMatricula"></label>
                  </div>
                  -->
                </div>
                <div class="row" style="display:none; !important">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <!-- cubrimiento -->
                        <!-- <select class="form-select form-select-sm" id="cubrimiento" style="display:none;"> -->
                        <!-- <select class="form-select form-select-sm" id="cubrimiento">
                          <option selected value="default">Modalidad</option>
                          <option value="Virtual">Virtual</option>
                          <option value="Presencial">Presencial</option>
                          <option value="Distancia">Distancia</option>
                        </select> -->
                        <input type="text" class="form-control form-control-sm " value="" id="cubrimiento" disabled>
                        <label class=" errLabel" for="cubrimiento" id="errCubrimiento"></label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <!-- promocion metodo financiamiento-->
                        <!-- <select class="form-select form-select-sm " id="promocion">
                          <option selected value="default">Promoción</option>
                        </select> -->
                        <!-- <input type="text" class="form-select form-select-sm " value="PAGO ANTICIPADO" id="promocion" style="display:none;"> -->
                        <input type="text" class="form-control form-control-sm " value="" id="promocion" disabled>
                        <label class=" errLabel" for="promocion" id="errPromocion"></label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <!-- periodo academico -->
                        <!-- <select class="form-select form-select-sm " id="periodo">
                          <option selected>Periodo académico</option>
                          <option value="xx">Periodo académico</option>
                        </select> -->
                        <input type="text" class="form-control form-control-sm " value="" id="periodo" disabled>
                        <label class=" errLabel" for="periodo" id="errPeriodo"></label>
                    </div>
                </div>
                <!-- TODO: se deja comentado y se deja valor default PAGO ANTICIPADO -->
                <div class="row">
                    <!-- campo oculto por que se precarg desde ajax -->
                    <div class="col-md-3 col-lg-3 col-sm-3" style="display:none; !important">
                        <!-- ciclo propedeutico -->
                        <!-- <select class="form-select form-select-sm " id="ciclo">
                          <option selected value="default">Ciclo</option>
                        </select> -->
                        <input type="text" class="form-control form-control-sm " value="" id="ciclo" disabled>
                        <label class=" errLabel" for="ciclo" id="errCiclo"></label>
                    </div>
                    <!-- campo oculto por que se precarg desde ajax -->
                    <div class="col-md-3 col-lg-3 col-sm-3" style="display:none; !important">
                        <!-- tipo de formacion -->
                        <!-- <select class="form-select form-select-sm " id="tipoFormacion">
                          <option selected value="default">Tipo de ingreso</option>
                        </select> -->
                        <input type="text" class="form-control form-control-sm " value="" id="tipoFormacion" disabled>
                        <label class=" errLabel" for="tipoFormacion" id="errTipoFormacion"></label>
                    </div>
                </div>

                <!-- valor matricula - idiomas - servicio medico -->
                <!--
              <select class="form-select form-select-sm " id="valorDescuento" style="display:none; !important">
                <option selected value="1">Sin descuento</option>
              </select>
              <label class=" errLabel" for="valorDescuento" id="errvalorDescuento"></label>
                -->
                <!-- cuotas -->
                <!--
              <select class="form-select form-select-sm " id="cuotas" style="display:none; !important">
                  <option selected value="default">Nro de cuotas</option>
              </select>
              <label class=" errLabel" for="cuotas" id="errCuotas"></label>
                -->
                <hr style="color:#8fca00; line-height:2px;">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div style="display:none;" id="valoresDiv" class="col-lg-6 col-md-6 col-sm-6 columnaContainer">
                            <!--<img src="views/resources/images/student-cun.png">-->
                            <div style="" class="row d-flex justify-content-center">
                                <div style="background-color: #E5E5E5; border-radius: 20px;" class="col-md-12 col-sm-12 col-xs-12 mt-auto">
                                    <p style="font-family: Montserrat, Sans-serif; font-weight: bold;" class="text-dark text-center mt-3" id="programaTitulo"></p>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif;" class="text-dark ps-md-5">Valor Matrícula</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif; color: #1e2e47; font-size: 20px;" class="text-end pe-md-5" id="valorPecuniarioMatriculaTexto"></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif; font-weight: bold !important;" class="text-danger ps-md-5">Valor Descuento</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif; color: #1e2e47; font-size: 20px; font-weight: bold !important;" class="text-end text-danger pe-md-5" id="valorDescuento"></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif;" class="text-dark ps-md-5">Matrícula con Descuento</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif; color: #1e2e47; font-size: 20px;" class="text-end pe-md-5" id="valorMatriculaTexto"></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif;" class="text-dark ps-md-5">Valor Idiomas</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif; color: #1e2e47; font-size: 20px;" class="text-end pe-md-5" id="valorIdiomasTexto"></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif;" class="text-dark ps-md-5">Valor Servicio Médico</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif; color: #1e2e47; font-size: 20px;" class="text-end pe-md-5" id="valorServicioMedicoTexto"></p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif;  font-weight: bold !important; font-size: 22px;" class="text-dark ps-md-5">Total</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <p style="font-family: Montserrat, Sans-serif; color: #1e2e47; font-size: 22px; font-weight: bold;" class="text-end pe-md-5" id="valorTotalMatriculaTexto"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display:none;" id="placetopayDiv" class="col-md-6 columnaContainer">
                            <div style="background-color: #E5E5E5; border-radius: 20px;" class="row">
                                <div class="col-md-12 d-flex justify-content-center pt-4 pb-3">
                                    <img class="img-fluid" style="width:55%; overflow-x:auto" src="views/resources/images/placetopay-logo.png">
                                </div>
                                <div class="col-md-12">
                                    <p style="font-family: Montserrat; font-size: 14px; color:#0C2340;" class="mx-4">Pague seguro a través de PlacetoPay.</p>
                                </div>
                                <div class="col-md-12">
                                    <p style="font-family: Montserrat; font-size: 14px; color:#0C2340;" class="mx-4">Tus datos personales se utilizarán para procesar tu pedido, mejorar tu experiencia en esta web y otros propósitos descritos en nuestra política de privacidad.</p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check ms-4">
                                        <input style="width:15px; height:15px;" class="form-check-input" type="checkbox" id="acceptConditionsBox" required>
                                        <label style="font-family: Montserrat; font-size: 14px; color:#0C2340; " class="form-check-label text-dark" for="flexCheckDefault">
                                            He leído y acepto los términos y condiciones *
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-10 text-center mt-2 mx-auto mb-3">
                                            <button type="button" id="pagoBtn" class="btn btn-registro btn-lg mx-auto px-0" onclick="registrar()" disabled>Pagar ahora con descuento</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </form>
            <!--/oldform-->
        </div>
    </div>
</div>

<!-- Modal Beneficiario -->
<div class="modal fade text-dark" id="agregaNuevo" tabindex="-1" aria-labelledby="agregaNuevo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="agregaNuevo">Datos de beneficiario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>
                    <!-- tipo de documento -->
                    <select class="form-select form-select-sm" id="tipoDocumento_b">
                        <option selected value="default">Tipo de documento</option>
                    </select>
                    <label class=" errLabel" for="tipoDocumento_b" id="errTipoDocumento_b"></label>

                    <!-- documento de identidad -->
                    <div class="input-group mb-3">
                        <input class="form-control form-control-sm input-sm" type="text" id="documento_b" placeholder="Nro de documento">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-light input-group-text" onclick="apiNames_b()"><i class="fas fa-check"></i></button>
                        </div>
                    </div>
                    <label class=" errLabel" for="documento_b" id="errDocumento_b"></label>

                    <!-- primer nombre -->
                    <input class="form-control form-control-sm input-sm" type="text" id="primerNombre_b" placeholder="Primer nombre">
                    <label class=" errLabel" for="primerNombre_b" id="errPrimerNombre_b"></label>

                    <!-- segundo nombre -->
                    <input class="form-control form-control-sm input-sm" type="text" id="segundoNombre_b" placeholder="Segundo Nombre">
                    <label class=" errLabel" for="segundoNombre_b" id="errSegundoNombre_b"></label>

                    <!-- primer apellido -->
                    <input class="form-control form-control-sm input-sm" type="text" id="primerApellido_b" placeholder="Primer apellido">
                    <label class=" errLabel" for="primerApellido_b" id="errPrimerApellido_b"></label>

                    <!-- segundo apellido -->
                    <input class="form-control form-control-sm input-sm" type="text" id="segundoApellido_b" placeholder="Segundo apellido">
                    <label class=" errLabel" for="segundoNombre_b" id="errSegundoApellido_b"></label>

                    <!-- genero -->
                    <select class="form-select form-select-sm " id="genero_b">
                        <option selected value="default">Género</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <label class=" errLabel" for="genero_b" id="errGenero_b"></label>

                    <hr>

                    <!--fecha de nacimiento-->
                    <label for="fechaNacimiento_b">Fecha de nacimiento2</label>
                    <input class="form-control form-control-sm input-sm " type="date" id="fechaNacimiento_b"/>
                    <label class=" errLabel" for="fechaNacimiento_b" id="errFechaNacimiento_b"></label>

                    <hr>

                    <!--fecha de expedicion de documento-->
                    <label for="fechaExpedicion_b">Expedición del documento</label>
                    <input class="form-control form-control-sm input-sm" type="date" id="fechaExpedicion_b" />
                    <label class=" errLabel" for="fechaExpedicion_b" id="errFechaExpedicion_b"></label>

                    <hr>

                    <!-- telefono fijo -->
                    <div class="input-group">
                        <div class="input-group-prepend">
              <span class="input-group-append" id="inputGroup-sizing-default">

                <select class="form-select form-select-sm" id="indicativo_b">
                  <option selected value="default">Indicativo</option>
                  <option value="601">601</option>
                  <option value="602">602</option>
                  <option value="603">603</option>
                  <option value="604">604</option>
                  <option value="605">605</option>
                  <option value="606">606</option>
                  <option value="607">607</option>
                  <option value="608">608</option>
                  <option value="609">609</option>
                </select>

              </span>
                        </div>

                        <input class="form-control form-control-sm input-sm" type="text" id="telefonoFijo_b" placeholder="Telefono fijo">
                    </div>
                    <label class=" errLabel" for="indicativo_b" id="errIndicativo_b"></label>
                    <label class=" errLabel" for="telefonoFijo_b" id="errTelefonoFijo_b"></label>


                    <!-- celular -->
                    <input class="form-control form-control-sm input-sm" type="text" id="celular_b" placeholder="Celular">
                    <label class=" errLabel" for="celular_b" id="errCelular_b"></label>

                    <!-- correo -->
                    <input class="form-control form-control-sm input-sm" type="email" id="correo_b" placeholder="Correo">
                    <label class=" errLabel" for="correo_b" id="errCorreo_b"></label>
                </form>
            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> -->
                <button type="button" class="btn btn-success" onclick="agregaBeneficiario()">Guardar</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
