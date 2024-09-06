<?php
define("ruta", 'FF');
include 'Admin/php/acceso.php';
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-55HFVKQC');</script>
    <!-- End Google Tag Manager -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Bienvenidos | CUN</title>
	<link rel="stylesheet" type="text/css" href="views/resources/bootstrap-5.0.2/css/bootstrap.min.css"/>
	<link rel="icon" type="image/png" href="views/resources/images/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="views/resources/fontawesome-free-5.15.3/css/all.css">
	<link rel="stylesheet" type="text/css" href="views/resources/css/general.styles.css">
	<link rel="stylesheet" type="text/css" href="views/resources/css/form.css">
    <link rel="stylesheet" type="text/css" href="views/resources/css/stepper.css">
    <!--Place to pay-->
    <script src="https://checkout.placetopay.com/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/buffer@6.0.3/index.min.js"></script>
    <!--CryptoJS-->
    <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.2.0/crypto-js.min.js"></script>
    <!--Monserrat font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<!--SweetAlert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55HFVKQC"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!--form page template-->
<div id="contenedor-spinner">
    <div id="spinner-border" class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<?php include 'views/modules/form.module.php'; ?>

<!--footer page template-->

<script type="text/javascript" src="views/resources/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="views/resources/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    let valorMatricula = '';
    $(document).ready(function(){
        $('#contenedor-spinner').css('display', 'flex');
        $('#contenedor-spinner').css('justify-content', 'center');
        $('#contenedor-spinner').css('align-items', 'center');
        $('#fechaNacimiento').prop('disabled', true);
        console.log(CryptoJS);
        if( $("#usuario_id").val() == '' ) return location.href = '/formulariocun/errors?err=404&messageErr=Usuario sin la sesión iniciada';

        //Eventos con el focus y validacion de campos en tiempo real
        $('#tipoDocumento').addClass('focus');
        $('#tipoDocumento').focus();

        //validamos el tipo de documento
        $('#tipoDocumento').on('change',function(){
            tipoDocumento = $(this).val();

            if(tipoDocumento == 'default'){
                $('#tipoDocumento').addClass('focus');
                $('#tipoDocumento').focus();
                errTipoDocumento = '* Selecciona el tipo de documento';
                $('#errTipoDocumento').html(errTipoDocumento);
            }else{
                errTipoDocumento = '';
                $('#errTipoDocumento').html(errTipoDocumento);

                $('#tipoDocumento').removeClass('focus');
                $('#documento').addClass('focus');
                $('#documento').focus();
            }
        });

        //validamos el documento
        $('#documento').on('input',function(){
            $('#documento').removeClass('focus');

            documento = $(this).val();

            if(!documento){
                errDocumento = '* Ingresa # de documento';
                $('#errDocumento').html(errDocumento);
                $('#documento').addClass('focus');
            }else if(!$.isNumeric(documento)){
                errDocumento = '* Formato no válido';
                $('#errDocumento').html(errDocumento);
                $('#documento').addClass('focus');
            }else{
                errDocumento = '';
                $('#errDocumento').html(errDocumento);
                $('#buttonCheckNames').addClass('buttonCheckNames');
            }
        });

        $('#buttonCheckNames').on('click',function(){
            $('#buttonCheckNames').removeClass('buttonCheckNames');
            $('#checkNombres').addClass('boxCheckNames');
            $('#genero').addClass('buttonCheckNames');
        });

        //validamos el primer nombre
        $('#primerNombre').on('keyup',function(){
            primerNombre = $(this).val();
            regex = /^[a-zA-ZñÑ]+$/;

            if(!primerNombre){
                errPrimerNombre = '* Ingresa el primer nombre';
                $('#errPrimerNombre').html(errPrimerNombre);
            }else if(!regex.test(primerNombre)){
                errPrimerNombre = '* Formato no válido';
                $('#errPrimerNombre').html(errPrimerNombre);
            }else{
                errPrimerNombre = '';
                $('#errPrimerNombre').html(errPrimerNombre);
            }
        });

        //validamos el segundo nombre
        $('#segundoNombre').on('keyup',function(){
            segundoNombre = $(this).val();
            var regex = /^[a-zA-ZñÑ]+$/;

            if(!regex.test(segundoNombre)){
                errSegundoNombre = '* Formato no válido';
                $('#errSegundoNombre').html(errSegundoNombre);
            }else{
                errSegundoNombre = '';
                $('#errSegundoNombre').html(errSegundoNombre);
            }
        });

        $('#segundoNombre').blur(function(){
            segundoNombre = $(this).val();

            if(segundoNombre == ''){
                errSegundoNombre = '';
                $('#errSegundoNombre').html(errSegundoNombre);
            }

        });

        //validamos el primer apellido
        $('#primerApellido').on('keyup',function(){
            primerApellido = $(this).val();
            regex = /^[a-zA-ZñÑ]+$/;

            if(!primerApellido){
                errPrimerApellido = '* Ingresa el primer apellido';
                $('#errPrimerApellido').html(errPrimerApellido);
            }else if(!regex.test(primerApellido)){
                errPrimerApellido = '* Formato no válido';
                $('#errPrimerApellido').html(errPrimerApellido);
            }else{
                errPrimerApellido = '';
                $('#errPrimerApellido').html(errPrimerApellido);
            }
        });

        //validamos el segundo apellido
        $('#segundoApellido').on('keyup',function(){
            segundoApellido = $(this).val();
            var regex = /^[a-zA-ZñÑ]+$/;

            if(!regex.test(segundoApellido)){
                errSegundoApellido = '* Formato no válido';
                $('#errSegundoApellido').html(errSegundoApellido);
                errorsCount++;
            }else{
                errSegundoApellido = '';
                $('#errSegundoApellido').html(errSegundoApellido);
            }
        });

        $('#segundoApellido').blur(function(){
            segundoApellido = $(this).val();

            if(segundoApellido == ''){
                errSegundoApellido = '';
                $('#errSegundoApellido').html(errSegundoApellido);
            }
        });

        //validamos genero
        $('#genero').on('change',function(){
            genero = $(this).val();
            $('#checkNombres').removeClass('boxCheckNames');

            if(genero == 'default'){
                errGenero = '* Selecciona el genero';
                $('#errGenero').html(errGenero);
                $('#genero').addClass('focus');
                $('#genero').focus();
            }else{
                errGenero = '';
                $('#errGenero').html(errGenero);
                $('#genero').removeClass('buttonCheckNames');
                $('#fechaNacimiento').addClass('focus');
                $('#fechaNacimiento').focus();
            }

        });

        //validamos fecha de nacimiento
        $('#fechaNacimiento').on('change',function(){
            $('#fechaNacimiento').removeClass('focus');

            let fechaNacimiento = $(this).val();
            let fechaExpedicion = $('#fechaExpedicion').val();

            //input date
            let bd = new Date(fechaNacimiento);
            let y_bd = bd.getFullYear();

            //valid range date
            let de = new Date(fechaExpedicion);
            let y_de = de.getFullYear();

            if(!fechaNacimiento){
                errFechaNacimiento = '* Selecciona la fecha de nacimiento';
                $('#errFechaNacimiento').html(errFechaNacimiento);
            }else if(y_bd > y_de){
                errFechaNacimiento = '* Fecha no válida, el año de nacimiento no puede ser mayor que el año de expedición';
                $('#errFechaNacimiento').html(errFechaNacimiento);
            }else{
                $('#fechaExpedicion').addClass('buttonCheckNames');
                errFechaNacimiento = '';
                $('#errFechaNacimiento').html(errFechaNacimiento);
            }

        });

        //validamos fecha de expedicion
        $('#fechaExpedicion').on('change',function(){
            $('#fechaNacimiento').prop('disabled', false);
            $('#fechaExpedicion').removeClass('buttonCheckNames');
            let fechaExpedicion = $(this).val();
            let tipoDocumento = $('#tipoDocumento').val();
            let fechaNacimiento = $('#fechaNacimiento').val();

            let bd = new Date(fechaNacimiento);
            let de = new Date(fechaExpedicion);

            let years = de.getFullYear() - bd.getFullYear();
            let monthsDiff = de.getMonth() - bd.getMonth();
            let daysDiff = de.getDate() - bd.getDate();

            if (monthsDiff < 0 || (monthsDiff == 0 && daysDiff < 0)) {
                years--;
            }

            console.log(years);

            if(!fechaExpedicion){
                errFechaExpedicion = '* Selecciona la fecha de expedicion';
                $('#errFechaExpedicion').html(errFechaExpedicion);
            } else {
                errFechaExpedicion = '';
                $('#errFechaExpedicion').html(errFechaExpedicion);
                $('#telefonoFijo').addClass('buttonCheckNames');
            }
        });

        //validamos indicativo
        $('#indicativo').on('change',function(){
            indicativo = $(this).val();

            if(indicativo == 'default'){
                errIndicativo = '* Selecciona el indicativo';
                $('#errIndicativo').html(errIndicativo);
                $('#indicativo').addClass('focus');
                $('#indicativo').focus();
            }else{
                errIndicativo = '';
                $('#errIndicativo').html(errIndicativo);
                $('#indicativo').removeClass('buttonCheckNames');
            }
        });

        //validamos telefono
        $('#telefonoFijo').on('input',function(){
            telefonoFijo = $(this).val();

            if(!telefonoFijo){
                errTelefonoFijo = '* Ingresa # de telefono';
                $('#errTelefonoFijo').html(errTelefonoFijo);
                $('#telefonoFijo').addClass('focus');
                $('#telefonoFijo').focus();
            }else if(!$.isNumeric(telefonoFijo)){
                errTelefonoFijo = '* Formato de telefono no válido';
                $('#errTelefonoFijo').html(errTelefonoFijo);
                $('#telefonoFijo').addClass('focus');
                $('#telefonoFijo').focus();
            }else{
                errTelefonoFijo = '';
                $('#errTelefonoFijo').html(errTelefonoFijo);
                $('#telefonoFijo').removeClass('focus');
                $('#telefonoFijo').removeClass('buttonCheckNames');
                $('#celular').addClass('buttonCheckNames');
            }
        });

        //validamos celular
        $('#celular').on('input',function(){
            $('#celular').removeClass('buttonCheckNames');

            celular = $(this).val();

            if(!celular){
                errCelular = '* Ingresa # de celular';
                $('#errCelular').html(errCelular);
                $('#celular').addClass('focus');
                $('#celular').focus();
            }else if(!$.isNumeric(celular)){
                errCelular = '* Formato no válido';
                $('#errCelular').html(errCelular);
                $('#celular').addClass('focus');
                $('#celular').focus();
            }else if(!celular.startsWith('3')){
                errCelular = '* Número no válido';
                $('#errCelular').html(errCelular);
                $('#celular').addClass('focus');
                $('#celular').focus();
            }else if(celular.length != 10){
                errCelular = '* El número debe ser de 10 digitos';
                $('#errCelular').html(errCelular);
                $('#celular').addClass('focus');
                $('#celular').focus();
            }else{
                errCelular = '';
                $('#errCelular').html(errCelular);
                $('#celular').removeClass('focus');
                $('#correo').addClass('focus');
                $('#correo').focus();
            }
        });

        //validamos correo
        $('#correo').on('input',function(){
            $('#correo').removeClass('buttonCheckNames');
            $('#cubrimiento').addClass('buttonCheckNames');

            correo = $('#correo').val();

            regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

            if(!correo){
                errCorreo = '* Ingresa el correo';
                $('#errCorreo').html(errCorreo);
            }else if(!regexEmail.test(correo)){
                errCorreo = '* Formato de correo no válido';
                $('#errCorreo').html(errCorreo);
            }else{
                errCorreo = '';
                $('#errCorreo').html(errCorreo);
            }
        });

        //validamos cubrimiento
        $('#cubrimiento').on('change',function(){
            $('#cubrimiento').removeClass('buttonCheckNames');
            $('#promocion').addClass('focus');
            $('#promocion').focus();
        });

        $('#promocion').on('change',function(){
            $('#promocion').removeClass('focus');
            $('#periodo').addClass('focus');
            $('#periodo').focus();
        });

        $('#periodo').on('change',function(){
            $('#periodo').removeClass('focus');
            $('#programa').addClass('focus');
            $('#programa').focus();
        });

        $('#programa').on('change',function(){
            $('#programa').removeClass('focus');
            $('#ciclo').addClass('focus');
            $('#ciclo').focus();
        });

        $('#ciclo').on('change',function(){
            $('#ciclo').removeClass('focus');
            $('#tipoFormacion').addClass('focus');
            $('#tipoFormacion').focus();
        });

        $('#tipoFormacion').on('change',function(){
            $('#tipoFormacion').removeClass('focus');
            $('#valorMatricula').addClass('focus');
            $('#valorMatricula').focus();
        });

        $('#valorMatricula').on('change',function(){
            $('#valorMatricula').removeClass('focus');
            $('#valorDescuento').addClass('focus');
            $('#valorDescuento').focus();
        });

        serverLocation = '<?php echo $_ENV['BACKEND_SERVER_URL']?>';

        //select tipo de documento
        $.ajax({
            url: serverLocation+'/tipo_documento.php',
            type: 'POST',
            success: function(r){
                console.log(r);
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';

                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].tipo_documento+'">'+obj[i].nombre_tipo_documento+'</option>';
                }

                $('#tipoDocumento').html(objHtml);
            },
            error: function() {
                console.log('fallida');
            }
        });

        //regionales o cubrimiento
        $.ajax({
            url: serverLocation+'/regional.php',
            type: 'POST',
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = 'Regional Bogotá';
                $('#cubrimiento').val(objHtml);
            }
        });

        //select tipo de promocion
        $.ajax({
            url: serverLocation+'/promocion_disponible.php',
            type: 'POST',
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';

                for(var i=0; i< obj.length; i++){
                    objHtml += obj[i].promocion;
                }

                $('#promocion').val(objHtml);
            }
        });

        // precargamos el valor del periodo con el consumo de la peticion
        $.ajax({
            url: serverLocation+'/periodo.php',
            type: 'POST',
            data: 'promocion='+promocion,
            success: function(r){
                $('#contenedor-spinner').css('display', 'none');
                console.log('respuesta periodo:')
                console.log(r);
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';
                for(var i=0; i< obj.length; i++){
                    objHtml += obj[i].periodo;
                }
                $('#periodo').val(objHtml);
            }
        });

        // precargamos valor de tecnico para el ciclo ya que venta directa simepre ingresa a ese ciclo
        var objHtml = 'TECNICO';
        $('#ciclo').val(objHtml);
        // precargamos valor de tipo formacionen normal ya que venta directa simepre ingresa en ese tipo de formacion
        var objHtml = 'NORMAL';
        $('#tipoFormacion').val(objHtml);


    });


    //cuando cambie correo carga el programa
    $('#correo').on('change',function(){
        $('#contenedor-spinner').css('display', 'flex');
        $('#contenedor-spinner').css('justify-content', 'center');
        $('#contenedor-spinner').css('align-items', 'center');
        periodo =  $("#periodo").val();
        promocion = $('#promocion').val();

        $.ajax({
            url: serverLocation+'/programa.php',
            type: 'POST',
            data: 'periodo='+periodo+'&promocion='+promocion,
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                var objHtml = '';

                for(var i=0; i< obj.length; i++){
                    objHtml += '<option value ="'+obj[i].programa+'">'+obj[i].programa+'</option>';
                }
                $('#programa').html('<option selected value="default">Programa académico</option>'+objHtml);
                $('#contenedor-spinner').css('display', 'none');
            }
        });
    });

    //cuando cambie programa carga valor de matricula
    $('#programa').on('change',function(){
        $('#contenedor-spinner').css('display', 'flex');
        $('#contenedor-spinner').css('justify-content', 'center');
        $('#contenedor-spinner').css('align-items', 'center');
        tipoFormacion = $("#tipoFormacion").val();
        console.log("tipoFormacion"+tipoFormacion);
        ciclo = $('#ciclo').val();
        console.log("ciclo"+ciclo);
        programa = $('#programa').val();
        console.log("programa"+programa);
        periodo =  $("#periodo").val();
        console.log("periodo"+periodo);
        promocion = $('#promocion').val();
        console.log("promocion"+promocion);
        $('#valoresDiv').css('display', 'block');
        $('#placetopayDiv').css('display', 'block');

        $.ajax({
            url: serverLocation+'/valor_matricula.php',
            type: 'POST',
            data: 'programa='+programa+'&periodo='+periodo+'&promocion='+promocion+'&ciclo='+ciclo+'&tipoFormacion='+tipoFormacion,
            success: function(r){
                var obj = JSON.parse(JSON.stringify(r));
                console.log(obj);
                $('#programaTitulo').text(programa);
                $('#valorPecuniarioMatriculaTexto').text(currencyFormatter({currency: 'USD', value: obj[0].valor_pecuniario.toString()} ));
                $('#valorMatriculaTexto').text(currencyFormatter({currency: 'USD', value: obj[0].valor_matricula.toString()} ));
                valorMatricula = $('#valorMatriculaTexto').text();
                $('#valorDescuento').text(currencyFormatter({currency: 'USD', value: (parseFloat(obj[0].valor_pecuniario) - parseFloat(obj[0].valor_matricula)).toString()} ));
                $('#valorIdiomasTexto').text(currencyFormatter({currency: 'USD', value: obj[0].valor_idiomas.toString()} ));
                $('#valorServicioMedicoTexto').text(currencyFormatter({currency: 'USD', value:obj[0].valor_servicio}));
                $('#valorTotalMatriculaTexto').text(currencyFormatter({currency: 'USD', value:(parseFloat(obj[0].valor_matricula) + parseFloat(obj[0].valor_idiomas) + parseFloat(obj[0].valor_servicio)).toString()}));
                $('#valorMatricula').val(parseFloat(obj[0].valor_matricula) + parseFloat(obj[0].valor_idiomas) + parseFloat(obj[0].valor_servicio));
                $('#pagoBtn').prop('disabled', false);
                $('#contenedor-spinner').css('display', 'none');
                console.log($('#valorMatricula').val());
            }
        });
    });

    function registrar() {
        let errorsCount = 0;

        //capturamos campos para validacion
        tipoDoc = $('#tipoDocumento').val();
        documento = $('#documento').val();
        primerNombre = $('#primerNombre').val();
        segundoNombre = $('#segundoNombre').val();
        primerApellido = $('#primerApellido').val();
        segundoApellido = $('#segundoApellido').val();
        genero = $('#genero').val();
        //genero = 'M';
        fechaNacimiento = $('#fechaNacimiento').val();
        //fechaNacimiento = '1999-01-01';
        fechaExpedicion = $('#fechaExpedicion').val();
        //fechaExpedicion = '2017-01-01';
        telefonoFijo = $('#telefonoFijo').val();
        //telefonoFijo = '00000000';
        indicativo = $('#indicativo').val();
        //indicativo = '601';
        celular = $('#celular').val();
        correo = $('#correo').val();
        cubrimiento = $('#cubrimiento').val();
        //cubrimiento = 'Bogota';
        promocion = $('#promocion').val();
        //promocion = $('#promocion').val();
        periodo = $('#periodo').val();
        //periodo =  $("#periodo").val();
        programa = $('#programa').val();
        ciclo = $('#ciclo').val();
        tipoFormacion = $('#tipoFormacion').val();
        valorMatricula = $('#valorMatricula').val();
        //valorDescuento = $('#valorDescuento').val();
        valorDescuento = 1;
        //cuotas = $('#cuotas').val();
        cuotas = 4;

        regex = /^[a-zA-ZñÑ]+$/;

        //validamos tipo documento
        if(tipoDoc == 'default'){
            errTipoDocumento = '* Selecciona el tipo de documento';
            errorsCount++;
            $('#errTipoDocumento').html(errTipoDocumento);
        }else{
            errTipoDocumento = '';
            $('#errTipoDocumento').html(errTipoDocumento);
            tipoDoc = $('#tipoDocumento').val();
        }

        //validamos documento
        if(documento == ''){
            errDocumento = '* Ingresa el # de documento';
            $('#errDocumento').html(errDocumento);
            errorsCount++;
        }else if(!$.isNumeric(documento)){
            errDocumento = '* Formato no válido';
            $('#errDocumento').html(errDocumento);
            errorsCount++;
        }else{
            errDocumento = '';
            $('#errDocumento').html(errDocumento);
            documento = $('#documento').val();
        }

        //validamos primer nombre
        if(!primerNombre){
            errPrimerNombre = '* Ingresa el primer nombre';
            $('#errPrimerNombre').html(errPrimerNombre);
            errorsCount++;
        }else if(!regex.test(primerNombre)){
            errPrimerNombre = '* Formato no válido';
            $('#errPrimerNombre').html(errPrimerNombre);
            errorsCount++;
        }else{
            errPrimerNombre = '';
            $('#errPrimerNombre').html(errPrimerNombre);
            primerNombre = $('#primerNombre').val();
            primerNombre = primerNombre.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
        }

        //validamos segundo nombre
        if(segundoNombre == ''){
            errSegundoNombre = '';
            $('#errSegundoNombre').html(errSegundoNombre);
            segundoNombre = $('#segundoNombre').val();
            segundoNombre = segundoNombre.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
        }else if(!regex.test(segundoNombre)){
            errSegundoNombre = '* Formato no válido';
            $('#errSegundoNombre').html(errSegundoNombre);
            errorsCount++;
        }

        //validamos primer apellido
        if(!primerApellido){
            errPrimerApellido = '* Ingresa el primer apellido';
            $('#errPrimerApellido').html(errPrimerApellido);
            errorsCount++;
        }else if(!regex.test(primerApellido)){
            errPrimerApellido = '* Formato no válido';
            $('#errPrimerApellido').html(errPrimerApellido);
            errorsCount++;
        }else{
            errPrimerApellido = '';
            $('#errPrimerApellido').html(errPrimerApellido);
            primerApellido = $('#primerApellido').val();
            primerApellido = primerApellido.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
        }

        //validamos segundo apellido
        if(!segundoApellido){
            errSegundoApellido = '* Ingresa el segundo apellido';
            $('#errSegundoApellido').html(errSegundoApellido);
            errorsCount++;
        }else if(!regex.test(segundoApellido)){
            errSegundoApellido = '* Formato no válido';
            $('#errSegundoApellido').html(errSegundoApellido);
            errorsCount++;
        }else{
            errSegundoApellido = '';
            $('#errSegundoApellido').html(errSegundoApellido);
            segundoApellido = $('#segundoApellido').val();
            segundoApellido = segundoApellido.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
        }

        //validamos genero
        if(genero == 'default'){
            errGenero = '* Selecciona el genero';
            $('#errGenero').html(errGenero);
            errorsCount++;
        }else{
            errGenero = '';
            $('#errGenero').html(errGenero);
            genero = $('#genero').val();
        }

        //validamos fecha de nacimiento
        let bd = new Date(fechaNacimiento);
        let de = new Date(fechaExpedicion);
        let y_bd = bd.getFullYear();
        let y_de = de.getFullYear();

        let years = de.getFullYear() - bd.getFullYear();
        let monthsDiff = de.getMonth() - bd.getMonth();
        let daysDiff = de.getDate() - bd.getDate();
        const age = 18;

        if (monthsDiff < 0 || (monthsDiff == 0 && daysDiff < 0)) {
            years--;
        }

        console.log('la edad es: ' + years);

        if (!fechaNacimiento) {
            errFechaNacimiento = '* Selecciona la fecha de nacimiento';
            $('#errFechaNacimiento').html(errFechaNacimiento);
            errorsCount++;
        } else if (y_bd > y_de) {
            errFechaNacimiento = '* Fecha no válida, el año de nacimiento no puede ser mayor que el año de expedición';
            $('#errFechaNacimiento').html(errFechaNacimiento);
            errorsCount++;
        } else if (((tipoDoc == 'C' || tipoDoc == 'E') && years < age) || (tipoDoc == 'T' && years >= age)) {
            errFechaNacimiento = '* La edad no corresponde con el tipo de documento';
            $('#errFechaNacimiento').html(errFechaNacimiento);
            errorsCount++;
            console.log(errFechaNacimiento);
        } else if (years == 0 || years < 0) {
            errFechaNacimiento = '* Edad errónea';
            $('#errFechaNacimiento').html(errFechaNacimiento);
            errorsCount++;
            console.log(errFechaNacimiento);
        } else {
            errFechaNacimiento = '';
            $('#errFechaNacimiento').html(errFechaNacimiento);
            fechaNacimiento = $('#fechaNacimiento').val();
        }

        //validamos fecha de expedicion
        if(!fechaExpedicion){
            errFechaExpedicion = '* Selecciona la fecha de expedicion';
            $('#errFechaExpedicion').html(errFechaExpedicion);
            errorsCount++;
        }else if(typeof tipoDocumento != 'undefined' && tipoDocumento == 'C'){
            if(y_de < age){
                errFechaExpedicion = '* Fecha no válida';
                $('#errFechaExpedicion').html(errFechaExpedicion);
                errorsCount++;
            }else{
                errFechaExpedicion = '';
                $('#errFechaExpedicion').html(errFechaExpedicion);
            }
        }else{
            errFechaExpedicion = '';
            $('#errFechaExpedicion').html(errFechaExpedicion);
            fechaExpedicion = $('#fechaExpedicion').val();

        }

        //validamos indicativo
        if(indicativo == 'default'){
            errIndicativo = '* Selecciona el indicativo';
            $('#errIndicativo').html(errIndicativo);
            $('#indicativo').addClass('focus');
            $('#indicativo').focus();
            errorsCount++;
        }else{
            errIndicativo = '';
            $('#errIndicativo').html(errIndicativo);
            $('#indicativo').removeClass('buttonCheckNames');
            indicativo = $('#indicativo').val();
        }

        //validamos celular
        if(!celular){
            errCelular = '* Ingresa # de celular';
            $('#errCelular').html(errCelular);
            errorsCount++;
        }else if(!$.isNumeric(celular)){
            errCelular = '* Formato no válido';
            $('#errCelular').html(errCelular);
            errorsCount++;
        }else if(!celular.startsWith('3')){
            errCelular = '* Número no válido';
            $('#errCelular').html(errCelular);
            errorsCount++;
        }else if(celular.length != 10){
            errCelular = '* El número debe ser de 10 digitos';
            $('#errCelular').html(errCelular);
            errorsCount++;
        }else{
            errCelular = '';
            $('#errCelular').html(errCelular);
            celular = $('#celular').val();
        }

        //validamos correo
        regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;

        if(!correo){
            errCorreo = '* Ingresa el correo';
            $('#errCorreo').html(errCorreo);
            errorsCount++;
        }else if(!regexEmail.test(correo)){
            errCorreo = '* Formato de correo no válido';
            $('#errCorreo').html(errCorreo);
            errorsCount++;
        }else{
            errCorreo = '';
            $('#errCorreo').html(errCorreo);
            correo = $('#correo').val();
        }

        cubrimiento = 'Bogota';
        promocion = $('#promocion').val();

        //validamos promoción
        if(promocion == 'default'){
            errPromocion = '* Selecciona la promoción';
            return $('#errPromocion').html(errPromocion);
        }else{
            errPromocion = '';
            $('#errPromocion').html(errPromocion);
            periodo = $('#promocion').val();
        }

        //validamos periodo
        if(periodo == 'default'){
            errPeriodo = '* Selecciona el periodo';
            return $('#errPeriodo').html(errPeriodo);
        }else{
            errPeriodo = '';
            $('#errPeriodo').html(errPeriodo);
            periodo = $('#periodo').val();
        }

        //validamos programa
        if(programa == 'default'){
            errPrograma = '* Selecciona el programa';
            errorsCount++;
            return $('#errPrograma').html(errPrograma);
        }else{
            errPrograma = '';
            $('#errPrograma').html(errPrograma);
            programa = $('#programa').val();
        }

        //validamos ciclo
        if(ciclo == 'default'){
            errCiclo = '* Selecciona el ciclo';
            return $('#errCiclo').html(errCiclo);
        }else{
            errCiclo = '';
            $('#errCiclo').html(errCiclo);
            ciclo = $('#ciclo').val();
        }

        //validamos tipo de formacion
        if(tipoFormacion == 'default'){
            errTipoFormacion = '* Selecciona el tipo de formacion';
            return $('#errTipoFormacion').html(errTipoFormacion);
        }else{
            errTipoFormacion = '';
            $('#errTipoFormacion').html(errTipoFormacion);
            tipoFormacion = $('#tipoFormacion').val();
        }

        //validamos valor matricula
        if(valorMatricula == 'default'){
            errValorMatricula = '* Selecciona valor que corresponda';
            return $('#errValorMatricula').html(errValorMatricula);
        }else{
            errValorMatricula = '';
            $('#errValorMatricula').html(errValorMatricula);
            valorMatricula = $('#valorMatricula').val();
        }

        usuario_id = $("#usuario_id").val();
        console.log(errorsCount);

        //si no hay errores
        if(!errorsCount && $('#acceptConditionsBox').is(':checked')){
            $('#contenedor-spinner').css('display', 'flex');
            $('#contenedor-spinner').css('justify-content', 'center');
            $('#contenedor-spinner').css('align-items', 'center');

            telefonoFijo = indicativo+telefonoFijo;

            if(promocion == '2 X 1' || promocion == 'CUN VIVE 2 X 1'){
                if(typeof beneficiario == 'undefined'){
                    errPromocion = '* Debes diligenciar los datos del beneficiario';
                    $('#errPromocion').html(errPromocion);
                    return;
                }else{
                    var info = {
                        tipo_documento : tipoDoc,
                        documento : documento,
                        primer_nombre :  primerNombre,
                        segundo_nombre : segundoNombre,
                        primer_apellido : primerApellido,
                        segundo_apellido :segundoApellido,
                        genero : genero,
                        fecha_nacimiento : fechaNacimiento,
                        fecha_expedicion : fechaExpedicion,
                        telefono_fijo : telefonoFijo,
                        celular : celular,
                        correo : correo,
                        cubrimiento : cubrimiento,
                        promocion : promocion,
                        periodo : periodo,
                        programa : programa,
                        ciclo : ciclo,
                        tipo_formacion : tipoFormacion,
                        valor_matricula : valorMatricula,
                        cuotas : cuotas,
                        beneficiario : beneficiario,
                        usuario_id: usuario_id,
                        valor_descuento: valorDescuento,
                    };
                }
            }else{
                var info = {
                    tipo_documento : tipoDoc,
                    documento : documento,
                    primer_nombre :  primerNombre,
                    segundo_nombre : segundoNombre,
                    primer_apellido : primerApellido,
                    segundo_apellido :segundoApellido,
                    genero : genero,
                    fecha_nacimiento : fechaNacimiento,
                    fecha_expedicion : fechaExpedicion,
                    telefono_fijo : telefonoFijo,
                    celular : celular,
                    correo : correo,
                    cubrimiento : cubrimiento,
                    promocion : promocion,
                    periodo : periodo,
                    programa : programa,
                    ciclo : ciclo,
                    tipo_formacion : tipoFormacion,
                    valor_matricula : valorMatricula,
                    cuotas : cuotas,
                    usuario_id: usuario_id,
                    valor_descuento: valorDescuento,
                };
            }

            let arrInfo = JSON.stringify(info);
            let cunToken = '';
            let processUrl = '';
            let reference = '';
            let requestID = '';
            let answerStatus = '';
            let answerDate = '';
            let answerMessage = '';
            let ppTransaction = '';
            let ppTransactionStatus = '';
            //console.log(info);

            let route = '<?php echo(getenv('BACKEND_SERVER_URL'))?>';
            //llama el servicio del back para registrar la promocion, retorna orden

            $.ajax({
                url: "<?php echo $_ENV['SERVICIOS_CUN_API']?>/auth/login",
                method: "POST",
                data: JSON.stringify({
                    "username": "<?php echo $_ENV['USUARIO_SERVICIOS']?>",
                    "password": "<?php echo $_ENV['PASSWORD_SERVICIOS']?>"
                }),
                dataType: "json",
                contentType: "application/json",
                success: function (r) {
                    $.ajax({
                        url: '<?php echo $_ENV['BACKEND_SERVER_URL']?>/LastTransactionByDocument.php',
                        method: 'POST',
                        data: {
                            document: documento
                        },
                        success: (r) => {
                            console.log(r);
                            let transaction = JSON.parse(r);
                            console.log(transaction);
                            console.log('validacion:')
                            console.log('el estado actual es:' + transaction['R_ESTADO']);

                            if (transaction) {
                                $.ajax({
                                    url: "<?php echo $_ENV['SERVICIOS_CUN_API']?>/auth/login",
                                    method: "POST",
                                    data: JSON.stringify({
                                        "username": "<?php echo $_ENV['USUARIO_SERVICIOS']?>",
                                        "password": "<?php echo $_ENV['PASSWORD_SERVICIOS']?>"
                                    }),
                                    dataType: "json",
                                    contentType: "application/json",
                                    success: function (r) {
                                        cunToken = r['token'];
                                        console.log('El token de login es: ' + cunToken);
                                        $.ajax({
                                            url: '<?php echo $_ENV['SERVICIOS_CUN_API']?>/transaccionesRealizadasPorReferencia',
                                            method: 'POST',
                                            headers: {
                                                'Authorization': 'Bearer ' + cunToken
                                            },
                                            data: JSON.stringify({
                                                'referencia': transaction['T_REFERENCIA'],
                                                "origen": "Venta Directa"
                                            }),
                                            dataType: "json",
                                            contentType: "application/json",
                                            success: function (r) {
                                                console.log('La transaccion encontrada al consumir transaccionesRealizadasPorReferencia es:');
                                                console.log(r);
                                                //trabajo actual
                                                let fechaActual = new Date();
                                                let seed = fechaActual.toISOString();
                                                let rawNonce = Math.floor(Math.random() * 1000000);
                                                let secretKey = '<?php echo $_ENV['PLACETOPAY_SECRET_KEY']?>';
                                                let login = '<?php echo $_ENV['PLACETOPAY_LOGIN']?>';
                                                trankey = CryptoJS.enc.Base64.stringify(
                                                    CryptoJS.SHA256(rawNonce.toString() + seed + secretKey)
                                                );
                                                let nonce = CryptoJS.enc.Base64.stringify(
                                                    CryptoJS.enc.Utf8.parse(rawNonce.toString())
                                                );

                                                $.ajax({
                                                    url: "<?php echo $_ENV['PLACETOPAY_URL']?>/api/session/" + r['requestId'],
                                                    method: "POST",
                                                    data: JSON.stringify({
                                                        auth: {
                                                            "tranKey": trankey,
                                                            "login": login,
                                                            "nonce": nonce,
                                                            "seed": seed
                                                        },
                                                        internalReference: r['referencia']
                                                    }),
                                                    dataType: "json",
                                                    contentType: "application/json",
                                                    success: function (r) {
                                                        console.log('Lo encontrado en placetopay es lo siguiente');
                                                        console.log(r);

                                                        if (r['status']['status'] == 'APPROVED') {
                                                            Swal.fire({
                                                                title: 'Alerta',
                                                                text: 'Ya tiene una transacción aprobada',
                                                                icon: 'warning',
                                                                confirmButtonText: 'Aceptar',
                                                                allowOutsideClick: false,
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    $('#contenedor-spinner').css('display', 'none');
                                                                }
                                                            });
                                                        }

                                                        if (r['status']['status'] == 'PENDING') {
                                                            Swal.fire({
                                                                title: 'Alerta',
                                                                text: 'Ya tiene una transacción en proceso',
                                                                icon: 'warning',
                                                                confirmButtonText: 'Aceptar',
                                                                allowOutsideClick: false,
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    $('#contenedor-spinner').css('display', 'none');
                                                                }
                                                            });
                                                        }

                                                        if (r['status']['status'] == 'REJECTED') {
                                                            placetopayPayment(info, arrInfo);
                                                        }

                                                        return false;
                                                    }
                                                });
                                            }
                                        });
                                    },
                                    error: function (r) {
                                        console.log('error en la peticion');
                                    }
                                });
                            }
                            console.log('la trasaccion de placetopay es la siguiente:')
                            console.log(ppTransaction);
                            //return false;

                            if ((transaction['R_ESTADO'] == 'REJECTED') || (! transaction) ) {
                                console.log('el estado actual es: ' + transaction['R_ESTADO']);
                                placetopayPayment(info, arrInfo);
                            }
                        },
                        error: (r) => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error en la plataforma, porfavor consulte al administrador',
                                icon: 'error',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#contenedor-spinner').css('display', 'none');
                                }
                            });
                        }
                    });

                },
                error: function (r) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error en la plataforma, porfavor consulte al administrador',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#contenedor-spinner').css('display', 'none');
                        }
                    });
                }
            });
        }else{
            Swal.fire({
                title: 'Alerta',
                text: 'Hay campos requeridos sin llenar',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#contenedor-spinner').css('display', 'none');
                }
            });
        }
    }

    function placetopayPayment(info, arrInfo)
    {
        $.ajax({
            url: serverLocation + '/registra_promocion.php',
            type: 'POST',
            data: {
                info: arrInfo
            },
            success: (r) => {
                console.log(arrInfo);
                reference = r['output'].slice(11);
                console.log(valorDescuento);

                console.log('Consumio servicio registra_promocion obtengo la referencia de pago para generar transaccion con placetopay y esta es la referencia: ' + reference);

                if (r['status'] == true) {
                    if (r['output'].includes('Salida: ERROR')) {
                        console.log('error');
                        Swal.fire({
                            title: 'Error!',
                            text: 'Salida: ERROR',
                            icon: 'error',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#contenedor-spinner').css('display', 'none');
                            }
                        });
                    } else {
                        //Ajax placetopay
                        let fechaActual = new Date();
                        let seed = fechaActual.toISOString();
                        let fechaVencimiento = new Date(fechaActual.setMinutes(fechaActual.getMinutes() + 60)).toISOString();
                        //fechaVencimiento = fechaVencimiento.toISOString();
                        let rawNonce = Math.floor(Math.random() * 1000000);
                        let secretKey = '<?php echo $_ENV['PLACETOPAY_SECRET_KEY']?>';

                        let trankey = CryptoJS.enc.Base64.stringify(
                            CryptoJS.SHA256(rawNonce.toString() + seed + secretKey)
                        );

                        let nonce = CryptoJS.enc.Base64.stringify(
                            CryptoJS.enc.Utf8.parse(rawNonce.toString())
                        );

                        jsonPP = {
                            "locale": "es_CO",
                            "buyer": {
                                "document": "" + info.documento,
                                "documentType": "CC",
                                "name": "" + info.primer_nombre + " " + info.segundo_nombre,
                                "surname": "" + info.primer_apellido + " " + info.segundo_apellido,
                                "email": "" + info.correo,
                                "mobile": "" + info.celular
                            },
                            "auth": {
                                "login": "<?php echo $_ENV['PLACETOPAY_LOGIN']?>",
                                "tranKey": trankey,
                                "nonce": nonce,
                                "seed": seed
                            },
                            "payment": {
                                "reference": reference,
                                "description": "Pago en placetopay",
                                "amount": {
                                    "currency": "COP",
                                    "total": info.valor_matricula
                                },
                            },
                            "expiration": fechaVencimiento,
                            "ipAddress": "190.184.202.245",
                            "returnUrl": "<?php echo $_ENV['FRONTEND_SERVER_URL']?>/views/transactionResult.php?reference=" + reference,
                            "userAgent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36"
                        };

                        console.log(jsonPP);

                        $.ajax({
                            url: '<?php echo $_ENV['PLACETOPAY_URL']?>/api/session',
                            type: 'POST',
                            data: jsonPP,
                            success: function (r) {
                                console.log('Consumimos api de session de placetopay para lanzar el modal con la siguiente ingformacion: ');
                                console.log(jsonPP);
                                console.log('El resultado  al consumir el api de sesion de placetopay es el siguiente: ');
                                console.log(r);

                                processUrl = r['processUrl'];
                                requestID = r['requestId']
                                answerStatus = r['status']['status'];
                                answerDate = r['status']['date'];
                                answerMessage = r['status']['message'];

                                $.ajax({
                                    url: "<?php echo $_ENV['SERVICIOS_CUN_API']?>/auth/login",
                                    method: "POST",
                                    data: JSON.stringify({
                                        "username": "<?php echo $_ENV['USUARIO_SERVICIOS']?>",
                                        "password": "<?php echo $_ENV['PASSWORD_SERVICIOS']?>"
                                    }),
                                    dataType: "json",
                                    contentType: "application/json",
                                    success: function (r) {
                                        cunToken = r['token'];

                                        let dataTransaccionPagos = {
                                            "unReferencia": reference,
                                            "unDocumento": jsonPP.buyer.document,
                                            "unTipoDocumento": "CC",
                                            "unName": jsonPP.buyer.name,
                                            "unSurname": jsonPP.buyer.surname,
                                            "unDescripcion": "Pago Venta Directa. Venta Directa",
                                            "unMoneda": "COP",
                                            "unValor": jsonPP.payment.amount.total,
                                            "unDireccionIp": "190.184.202.242",
                                            "unNavegador": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36",
                                            "unFecha": answerDate,
                                            "unFechaRespuesta": null,
                                            "unEstado": "PENDING",
                                            "unRequestId": requestID,
                                            "unEstadoRespuesta": answerStatus,
                                            "unRazon": null,
                                            "unMensaje": answerMessage,
                                            "unOrigen": "<?php echo $_ENV['ENTORNO_PLACE_TO_PAY']?>",
                                            "unCodigoBanco": null,
                                            "unNombreBanco": null,
                                            "unTipoCuenta": null,
                                            "unNumeroCuenta": null
                                        }

                                        $.ajax({
                                            url: "<?php echo $_ENV['SERVICIOS_CUN_API']?>/transaccionPagos",
                                            method: "POST",
                                            headers: {
                                                'Authorization': 'Bearer ' + cunToken
                                            },
                                            data: JSON.stringify(dataTransaccionPagos),
                                            dataType: "json",
                                            contentType: "application/json",
                                            success: function (r) {
                                                console.log('Consumimos api transaccionPagos con la siguiente información: ');
                                                console.log(dataTransaccionPagos);

                                                if (r['code'] == 200) {
                                                    $('#contenedor-spinner').css('display', 'none');
                                                    //Lanzamos el modal de place to pay
                                                    P.init(processUrl)
                                                    P.on('response', (r) => {
                                                        console.log('se desencadeno respuesta')
                                                        console.log(answerDate);
                                                        location.href = 'views/transactionResult.php?reference=' + r['reference'];
                                                    });
                                                } else {
                                                    $('#contenedor-spinner').css('display', 'none');
                                                    Swal.fire({
                                                        title: 'Error!',
                                                        text: 'La orden ya esta financiada',
                                                        icon: 'error',
                                                        confirmButtonText: 'Aceptar',
                                                        allowOutsideClick: false,
                                                    });

                                                    /*
                                                    P.init(processUrl)
                                                    P.on('response', (r) => {
                                                        console.log('se desencadeno respuesta')
                                                        console.log(answerDate);
                                                        location.href = 'views/transactionResult.php?reference='+r['reference'];
                                                    });
                                                    */
                                                }
                                            },
                                            error: function () {
                                                console.log('transaccionPagos error al consumir')
                                            }
                                        });
                                    },
                                    error: function (r) {
                                        console.log('error token')
                                    }
                                });
                            },
                            error: function () {
                                console.log('no entro');
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Tiene respuesta 200 pero false',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#contenedor-spinner').css('display', 'none');
                        }
                    });
                }
            },
            error: function (error) {
                console.log('error servidor error 500');
                Swal.fire({
                    title: 'Error!',
                    text: 'Error servidor error 500',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#contenedor-spinner').css('display', 'none');
                    }
                });
            }
        });
    }

    function currencyFormatter({currency, value}) {
        const formatter = new Intl.NumberFormat('es-ES', {
            currency
        })
        return '$' + formatter.format(value)
    }

</script>
	<!--<script type="text/javascript" src="views/resources/js/form.js?v=<?php echo(rand()); ?>"></script>-->
<!--stepper-->
<script>
    const stepperContainer = document.querySelector('.stepper-container');
    let isDown = false;
    let startX;
    let scrollLeft;

    stepperContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        stepperContainer.classList.add('active');
        startX = e.pageX - stepperContainer.offsetLeft;
        scrollLeft = stepperContainer.scrollLeft;
    });

    stepperContainer.addEventListener('mouseleave', () => {
        isDown = false;
        stepperContainer.classList.remove('active');
    });

    stepperContainer.addEventListener('mouseup', () => {
        isDown = false;
        stepperContainer.classList.remove('active');
    });

    stepperContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - stepperContainer.offsetLeft;
        const walk = (x - startX) * 2; // Velocidad de desplazamiento
        stepperContainer.scrollLeft = scrollLeft - walk;
    });

    function nextStep(step)
    {
        if (step == 4 && valorMatricula != '') {
            $('#valoresDiv').css('display', 'block');
            $('#placetopayDiv').css('display', 'block');
        }

        console.log(valorMatricula);
        document.querySelectorAll('.step').forEach(function (element) {
            element.classList.remove('active');
        });
        document.querySelector('#step-' + step).classList.add('active');

        document.querySelectorAll('.stepper-item').forEach(function (element, index) {
            if (index < step) {
                element.classList.add('completed');
            }
            if (index == step - 1) {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }
        });
    }

    function prevStep(step)
    {
        console.log(valorMatricula);
        if (step < 4) {
            $('#valoresDiv').css('display', 'none');
            $('#placetopayDiv').css('display', 'none');
        }

        document.querySelectorAll('.step').forEach(function (element) {
            element.classList.remove('active');
        });
        document.querySelector('#step-' + step).classList.add('active');

        document.querySelectorAll('.stepper-item').forEach(function (element, index) {
            if (index < step) {
                element.classList.add('completed');
            } else {
                element.classList.remove('completed');
            }
            if (index == step - 1) {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }
        });
    }
</script>
<!--/stepper-->

</body>
<?php include 'views/modules/footer.module.php';?>
</html>
