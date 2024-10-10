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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" id="viewportMeta"/>
    <title>Resultado transacción</title>
    <link rel="stylesheet" type="text/css" href="../views/resources/bootstrap-5.0.2/css/bootstrap.css"/>
    <link rel="icon" type="image/png" href="../views/resources/images/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="../views/resources/fontawesome-free-5.15.3/css/all.css">
    <link rel="stylesheet" type="text/css" href="../views/resources/css/general.styles.css">
    <link rel="stylesheet" type="text/css" href="../views/resources/css/answer.css">
    <link rel="stylesheet" type="text/css" href="../views/resources/css/form.css">
    <!--Material icons-->
    <link href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css" rel="stylesheet">
    <!--JQuery-->
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <!--Monserrat font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!--CryptoJS-->
    <script src="https://cdn.jsdelivr.net/npm/crypto-js@4.2.0/crypto-js.min.js"></script>
    <!--jsPDF-->
    <!--<script src="../views/resources/js/jspdf.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="/views/resources/js/fonts/Montserrat-font.js"></script>
    <!--html2canvas-->
    <script src="../views/resources/js/html2canvas.min.js"></script>
    <script>
        window.html2canvas = html2canvas;
        window.jsPDF = window.jspdf.jsPDF;
    </script>
</head>
<body style="background-color: #1e2e47">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55HFVKQC"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="contenedor-spinner" style="display: flex; justify-content: center; align-items: center">
    <div id="spinner-border" class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div id="superiorBar" class="container-fluid text-center superiorBar">
    <img id="cunLogo" style="width:14rem;" src="../views/resources/images/cun-40.png" alt="logo_cun" />
</div>
<div class="container">
    <div style="width: 100%;" class="justify-content-center mt-5">
        <div id="container" class="col-md-10 rounded-2 bg-white mx-auto">
            <p class="text-center mt-3">
                <img style="width:5rem;" class="mt-4" id="imgEstado">
            </p>
            <div class="w-100"></div>
            <p style="font-family: Montserrat, Sans-serif; font-size:300%;" class="text-center font-weight-bold" id="estadoParrafo"></p>
            <p style="font-family: Montserrat, Sans-serif; font-size:1rem;" class="text-center font-weight-bold text-dark pb-4" id="detalleParrafo"></p>
            <div id="transactionResultBody" class="row justify-content-center">
                <div id="detailCard" style="border-radius: 10px;" class="col-md-10 col-11 border px-md-5 pt-5">
                    <div class="row">
                        <div style="display:none;" class="col-md-6 col-6 mb-4 userData">
                        </div>
                        <div style="display:none;" class="col-md-6 col-6 mb-4 userData">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 500;" class="text-end text-dark mb-0" id="usuario"></p>
                            <p style="font-family: Montserrat, Sans-serif; font-size:1em;" class="text-end text-secondary mb-0" id="document"></p>
                            <p style="font-family: Montserrat, Sans-serif; font-size:1em; word-wrap: break-word;" class="text-end text-secondary mb-0" id="email"></p>
                        </div>

                        <div class="col-md-6 col-6 mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 500;" class="text-start text-dark mb-0">Fecha</p>
                        </div>
                        <div class="col-md-6 col-6 mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 500;" class="text-end text-dark mb-0" id="fecha"></p>
                        </div>
                        <div class="col-md-6 col-6  mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 500;" class="text-start text-dark mb-0">No. de Referencia</p>
                        </div>
                        <div class="col-md-6 col-6 mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 500;" class="text-end text-dark mb-0" id="referencia"></p>
                        </div>
                        <div class="col-md-6 col-6  mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 500;" class="text-start text-dark mb-0" id="paymentMethodLabel">Método de Pago</p>
                        </div>
                        <div class="col-md-6 col-6 mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 500;" class="text-end text-dark mb-0" id="paymentMethod"></p>
                        </div>
                        <div class="col-md-6 col-6  mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.2em; font-weight: 700; display:none;" class="text-start text-dark mb-0" id="valorDiv">Total Pagado</p>
                        </div>
                        <div class="col-md-6 col-6 mb-4">
                            <p style="font-family: Montserrat, Sans-serif; font-size:1.5em; font-weight: 700; display:none;" class="text-end text-dark mb-0" id="valor"></p>
                        </div>
                    </div>
                </div>
                <hr style="color: black; width: 83%; height: 2px;" class="mt-3 bg-secondary">
                <div class="col-md-12 mt-3 d-flex justify-content-center">
                    <p class="text-dark text-center w-75" style="font-size:19px;" id="transactionAlert"></p>
                </div>
                <div class="col-md-12 d-flex justify-content-center mb-4"">
                <div style="width:17em; display:none;" class="px-0 mx-1" id="downloadPDFButtonDiv">
                    <a href="#" class="btn btn-light mt-4 mb-4 w-100 text-center border border-secondary pt-2" style="background-color: #FAFAFA" id="downloadPDFButton">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-2 px-0 d-flex justify-content-end align-items-center mr-3">
                                <i class="material-icons">file_download</i>
                            </div>
                            <div class="col-10 ml-3">
                                <span style="word-wrap: break-word; font-size: 16px;" class="w-100 px-0">Descargar Comprobante</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div style="width:18em; display:none;" class="px-0 mx-1" id="iniciarInscripcionButtonDiv">
                    <a href="https://cun.edu.co/" class="btn mt-4 mb-4 w-100 text-center p-0" style="background-color: #8fca00; box-shadow: 1px 0.5px 1px 1px rgba(32,32,32,0.3);" id="iniciarInscripcionButton">
                        <div class="row py-1 d-flex justify-content-center align-items-center">
                            <div class="col-2 p-0 me-4">
                                <i class="material-icons ms-2"><img src="resources/images/cun-icon.png"></i>
                            </div>
                            <div class="col-7 ml-3 px-0 pt-1 me-4">
                                <span style="word-wrap: break-word; font-size: 16px" class="w-100 mb-2 me-3">Iniciar Inscripción</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div style="width:18em; display:none;" class="px-0 mx-1" id="reintentarTransaccionButtonDiv">
                    <a href="{{getenv('FRONTEND_SERVER_URL')}}" class="btn mt-4 mb-4 w-100 text-center p-0" style="background-color: #8fca00; box-shadow: 1px 0.5px 1px 1px rgba(32,32,32,0.3);" id="reintentarTransaccionButton">
                        <div class="row py-1 d-flex justify-content-center align-items-center">
                            <div class="col-1 p-0 me-4">
                                <i class="material-icons ms-4"><img src="resources/images/cun-icon.png"></i>
                            </div>
                            <div class="col-9 ml-3 px-0 pt-1 me-4">
                                <span style="word-wrap: break-word; font-size: 16px" class="w-100 mb-2 me-3">Reintentar Transacción</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div style="width:18em; display:none;" class="px-0 mx-1" id="pagPrincipalButtonDiv">
                    <a href="https://cun.edu.co/" class="btn mt-4 mb-4 w-100 text-center p-0" style="background-color: #8fca00; box-shadow: 1px 0.5px 1px 1px rgba(32,32,32,0.3);" id="pagPrincipalButton">
                        <div class="row py-1 d-flex justify-content-center align-items-center">
                            <div class="col-1 p-0 me-4">
                                <i class="material-icons ms-4"><img src="resources/images/cun-icon.png"></i>
                            </div>
                            <div class="col-9 ml-3 px-0 pt-1 me-4">
                                <span style="word-wrap: break-word; font-size: 16px" class="w-100 mb-2 me-3">Ir a la pagina principal</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--footer-->
<footer style="background-color: #182437; margin-top: 10vh !important" class="text-center text-white">
    <div class="row justify-content-center ">
        <div class="col-md-9 mt-3">
            <p> Línea Bogotá: (+57) (601) 307 81 80  |  Gratis desde tu cel: 01 8000 11 54 11  |  Sede principal Bogotá: Calle 12b #04-79

                <br>
                Corporación Unificada Nacional de Educación Superior CUN – Código SNIES 4813, Colombia - Todos los derechos reservados.
                Carácter Institucional: Institución técnica profesional «Vigilada por el Ministerio de Educación Nacional».
                Personería Jurídica: Resolución 1379 del 3 de febrero de 1983. Ministerio de Educación Nacional.
                <br>
                Institución de educación superior sujeta a la inspección y vigilancia del Mineducación.
                <br>
                Copyright © 2024 | Para notificaciones judiciales: notificaciones@cun.edu.co
            </p>
        </div>
    </div>
</footer>

</div>
<script type="text/javascript">
    //$('#spinner').show();
    $(document).ready(function(){
        let serverLocation = '{{getenv('BACKEND_SERVER_URL')}}';
        let referencia = '';
        let fechaTransaccion = '';
        let concepto = '';
        let valor = '';
        let estado = '';
        let cunToken = '';
        let reason = '';
        let internalReference = '';
        let paymentMethod = '';
        let paymentMethodName = '';
        let issuerName = '';
        let currency = '';
        let total = '';
        let currency2 = '';
        let total2 = '';
        let factor = '';
        let authorization = '';
        let reference2 = '';
        let receipt = '';
        let franchise = '';
        let refunded = '';
        let dater = '';
        let name = '';
        let surname = '';
        let document = '';
        let documentType = '';
        let email = '';
        let estadoParrafo = '';
        let detalleParrafo = '';

        $.ajax({
            url: "{{getenv('SERVICIOS_CUN_API')}}/auth/login",
            method: "POST",
            data: JSON.stringify({
                "username": "{{getenv('USUARIO_SERVICIOS')}}",
                "password": "{{getenv('PASSWORD_SERVICIOS')}}"
            }),
            dataType: "json",
            contentType: "application/json",
            success: function (r) {
                cunToken = r['token'];
                console.log(cunToken);
                $.ajax({
                    url: '{{getenv('SERVICIOS_CUN_API')}}/transaccionesRealizadasPorReferencia',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + cunToken
                    },
                    data: JSON.stringify({
                        'referencia': '{{$reference}}',
                        "origen":"Venta Directa"
                    }),
                    dataType: "json",
                    contentType: "application/json",
                    success: function(r){
                        referencia = r['referencia'];
                        fechaTransaccion = r['fecha'];
                        let fechaActual = new Date();
                        let seed = fechaActual.toISOString();
                        let rawNonce = Math.floor(Math.random() * 1000000);
                        let secretKey = '{{getenv('PLACETOPAY_SECRET_KEY')}}';
                        let login = '{{getenv('PLACETOPAY_LOGIN')}}';
                        let requestID = r['requestId'].toString();
                        trankey = CryptoJS.enc.Base64.stringify(
                            CryptoJS.SHA256(rawNonce.toString() + seed + secretKey)
                        );
                        let nonce = CryptoJS.enc.Base64.stringify(
                            CryptoJS.enc.Utf8.parse(rawNonce.toString())
                        );
                        console.log('trankey: '+ trankey);

                        $.ajax({
                            url: "{{getenv('PLACETOPAY_URL')}}/api/session/"+requestID,
                            method: "POST",
                            data: JSON.stringify({
                                auth:{
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
                                concepto = r['status']['message'].toString();
                                console.log('sin nada objeto');
                                console.log(r);
                                estado = r['status']['status'].toString();

                                if (r['payment'] != null) {
                                    valor = r['payment'][0]['amount']['from']['total'].toString();
                                    reason = r['status']['reason'].toString();
                                    internalReference = r['payment'][0]['internalReference'];
                                    issuerName = r['payment'][0]['issuerName'];
                                    currency = r['payment'][0]['amount']['from']['currency'].toString();
                                    total = r['payment'][0]['amount']['from']['total'];
                                    currency2 = r['payment'][0]['amount']['to']['currency'].toString();
                                    total2 = r['payment'][0]['amount']['to']['total'];
                                    factor = r['payment'][0]['amount']['factor'];
                                    authorization = r['payment'][0]['authorization'];
                                    reference2 = r['payment'][0]['reference'];
                                    receipt = r['payment'][0]['receipt'];
                                    franchise = r['payment'][0]['franchise'];
                                    refunded = r['payment'][0]['refunded'];
                                    dater = r['status']['date'].toString();
                                    paymentMethodName = r['payment'][0]['paymentMethodName'];
                                    paymentMethod = r['payment'][0]['paymentMethod'];
                                    name = r['request']['buyer']['name'];
                                    surname = r['request']['buyer']['surname'];
                                    document = r['request']['buyer']['document'];
                                    documentType = r['request']['buyer']['documentType'];
                                    email = r['request']['buyer']['email'];

                                    console.log('consumimos el api de placetopay para obtener la transaccion, hacemos la peticion con la referencia de pago, al hacer esa peticion obtenemos lo siguiente: ')
                                    console.log(r);
                                }


                                $.ajax({
                                    url: "{{getenv('SERVICIOS_CUN_API')}}/auth/login",
                                    method: "POST",
                                    data: JSON.stringify({
                                        "username": "{{getenv('USUARIO_SERVICIOS')}}",
                                        "password": "{{getenv('PASSWORD_SERVICIOS')}}"
                                    }),
                                    dataType: "json",
                                    contentType: "application/json",
                                    success: function(r){
                                        cunToken = r['token'];
                                        //console.log('el nuevo token es ' + cunToken);
                                        let jsonApiZoho = JSON.stringify({
                                            "documento": document,
                                            "nombre": name + ' ' + surname,
                                            "correo": email,
                                            "estadoTransaccion": estado
                                        });
                                        console.log(jsonApiZoho);

                                        $.ajax({
                                            url: serverLocation + "/zohoAPI.php",
                                            method: "POST",
                                            data: {
                                                info: jsonApiZoho
                                            },
                                            success: function (r) {
                                                console.log(r);
                                                console.log('se consumio api zoho');
                                            },
                                            error: function (r) {
                                                console.log(r);
                                                console.log('no se pudo consumir api zoho');
                                            }
                                        });

                                        if (estado == 'APPROVED' || estado == 'REJECTED') {
                                            console.log('el estado es: '+ estado)
                                            let dataRespuestaPagos = {
                                                "unReferencia": referencia,
                                                "unStatus": estado,
                                                "unReason": reason,
                                                "unMessage": concepto,
                                                "unDater": dater,
                                                "unInternalReference": internalReference,
                                                "unPaymentMethod": paymentMethod,
                                                "unPaymentMethodName": paymentMethodName,
                                                "unIssuerName": issuerName,
                                                "unCurrency": currency,
                                                "unTotal": total,
                                                "unCurrency2": currency2,
                                                "unTotal2": total2,
                                                "unFactor": factor,
                                                "unAuthorizacion": authorization,
                                                "unReference": reference2,
                                                "unReceipt": receipt,
                                                "unFranchise": franchise,
                                                "unRefunded": refunded
                                            };

                                            $.ajax({
                                                url: "{{getenv('SERVICIOS_CUN_API')}}/respuestaPagos",
                                                method: "POST",
                                                headers: {
                                                    "Authorization": "Bearer " + cunToken
                                                },
                                                data: JSON.stringify(dataRespuestaPagos),
                                                dataType: "json",
                                                contentType: "application/json",
                                                success: function (r) {
                                                    console.log('se consume la api respuestaPagos, donde se guarda el resultado de la transaccion en la BD de la CUN, se consume con la siguiente data:  ');
                                                    console.log(dataRespuestaPagos);
                                                    //console.log('guardo respuesta pago');
                                                    $.ajax({
                                                        url: "{{getenv('SERVICIOS_CUN_API')}}/auth/login",
                                                        method: "POST",
                                                        data: JSON.stringify({
                                                            "username": "{{getenv('USUARIO_SERVICIOS')}}",
                                                            "password": "{{getenv('PASSWORD_SERVICIOS')}}"
                                                        }),
                                                        dataType: "json",
                                                        contentType: "application/json",
                                                        success: function (r) {
                                                            console.log('se pudo loguear despues de guardar respuesta pago');
                                                        },
                                                        error: function (r) {
                                                            console.log('no se pudo loguear despues de guardar respuesta pago');
                                                        }
                                                    });
                                                },
                                                error: function (r) {
                                                    console.log('no guardo respuesta pago');
                                                }
                                            });
                                        }
                                    },
                                    error: function(r) {
                                        console.log('no se pudo obtener el nuevo token');
                                    }
                                });

                                if (estado == 'REJECTED' && r['payment'] == null ) {
                                    estadoParrafo = 'Transacción cancelada';
                                    detalleParrafo = 'La petición ha sido cancelada por el usuario';
                                    $('#imgEstado').attr('src', '../views/resources/images/fail-icon.png');
                                    $('#estadoParrafo').text(estadoParrafo);
                                    $('#estadoParrafo').css('color','#CE0058');
                                    $('#detalleParrafo').text(detalleParrafo)
                                    $('#detailCard').css('background-color', '#E396B7');
                                    $('#fecha').text(fechaTransaccion);
                                    $('#referencia').text(referencia);
                                    $('#paymentMethodLabel').css('display', 'none')
                                    console.log('entro');
                                    $('#contenedor-spinner').css('display', 'none');
                                    return false
                                }

                                if (estado == 'PENDING' && r['payment'] == null ) {
                                    console.log('estado pendiente')
                                    estadoParrafo = 'Transacción pendiente';
                                    detalleParrafo = 'Tu pago está actualmente pendiente de confirmación.';
                                    $('#imgEstado').attr('src', '../views/resources/images/alert.png');
                                    $('#estadoParrafo').text(estadoParrafo);
                                    $('#estadoParrafo').css('color','#FFCD00');
                                    $('#detalleParrafo').text(detalleParrafo);
                                    $('#detalleParrafo').css('color', '#000000');
                                    $('#detailCard').css('background-color', '#ffeea6');
                                    $('#valorDiv').css('display', 'block');
                                    $('#valor').css('display', 'block');
                                    $('.userData').css('display', 'block');
                                    $('#fecha').text(r['status']['date'].toString());
                                    $('#referencia').text(r['request']['payment']['reference']);
                                    $('#paymentMethodLabel').css('display', 'none');
                                    $('#paymentMethod').css('display', 'none');
                                    $('#valor').text(r['request']['payment']['amount']['total']); //currencyFormatter({'COP', r['request']['payment']['amount']['total']})
                                    $('#transactionAlert').html('Recibirás una notificación por correo electrónico una vez que el pago haya sido procesado. Gracias por tu paciencia..')
                                    $('#pagPrincipalButtonDiv').css('display','block')
                                    $('#contenedor-spinner').css('display', 'none');
                                    return false
                                }

                                if (estado == "APPROVED") {
                                    estadoParrafo = 'Transacción exitosa';
                                    detalleParrafo = 'El pago se completó y recibió exitosamente';
                                    $('#imgEstado').attr('src', '../views/resources/images/success-icon.png');
                                    $('#estadoParrafo').text(estadoParrafo);
                                    $('#estadoParrafo').css('color','#00B388');
                                    $('#detalleParrafo').text(detalleParrafo);
                                    $('#detailCard').css('background-color', '#00B38859');
                                    $('#valorDiv').css('display', 'block');
                                    $('#valor').css('display', 'block');
                                    $('.userData').css('display', 'block');
                                    $('#transactionAlert').html('<strong>¡Felicidades!</strong>, estás a un par de pasos de ser todo un Cunista! Formaliza tu proceso a través de nuestra <strong>Plataforma SINÚ</strong>.')
                                    //$('#transactionResultBody').append('<div class="col-md-12 d-flex justify-content-center mb-4"> <div style="width:17em;" class="px-0 mx-1"> <a href="#" class="btn btn-light mt-4 mb-4 w-100 text-center border border-secondary pt-2" style="background-color: #FAFAFA" id="downloadPDFButton" onclick="downloadPDF()"> <div class="row d-flex justify-content-center align-items-center"> <div class="col-2 px-0 d-flex justify-content-end align-items-center mr-3"> <i class="material-icons">file_download</i> </div> <div class="col-10 ml-3"> <span style="word-wrap: break-word; font-size: 16px;" class="w-100 px-0">Descargar Comprobante</span> </div> </div> </a> </div> <div style="width:18em;" class="px-0 mx-1"> <a href="https://cun.edu.co/" class="btn mt-4 mb-4 w-100 text-center p-0" style="background-color: #8fca00; box-shadow: 1px 0.5px 1px 1px rgba(32,32,32,0.3);" onclick="downloadPDF()"> <div class="row py-1 d-flex justify-content-center align-items-center"> <div class="col-2 p-0 me-4"> <i class="material-icons ms-2"><img src="resources/images/cun-icon.png"></i> </div> <div class="col-7 ml-3 px-0 pt-1 me-4"> <span style="word-wrap: break-word; font-size: 16px" class="w-100 mb-2 me-3">Iniciar Inscripción</span> </div> </div> </a> </div>');
                                    $('#downloadPDFButtonDiv').css('display', 'block');
                                    $('#iniciarInscripcionButtonDiv').css('display', 'block');
                                }

                                if (estado == "REJECTED") {
                                    estadoParrafo = 'Transacción rechazada';
                                    detalleParrafo = 'Lamentamos informarte que el pago ha sido rechazado';
                                    $('#imgEstado').attr('src', '../views/resources/images/fail-icon.png');
                                    $('#estadoParrafo').text(estadoParrafo);
                                    $('#estadoParrafo').css('color','#CE0058');
                                    $('#detalleParrafo').text(detalleParrafo)
                                    $('#detailCard').css('background-color', '#E396B7');
                                    $('#transactionAlert').html('Por favor verifica la información del medio de pago que elegiste o inténtalo con otro método.');
                                    $('#downloadPDFButtonDiv').css('display', 'block');
                                    $('#reintentarTransaccionButtonDiv').css('display', 'block');
                                }

                                if (estado == "PENDING") {
                                    estadoParrafo = 'Transacción pendiente';
                                    detalleParrafo = 'Tu pago está actualmente pendiente de confirmación.';
                                    $('#imgEstado').attr('src', '../views/resources/images/alert.png');
                                    $('#estadoParrafo').text(estadoParrafo);
                                    $('#estadoParrafo').css('color','#FFCD00');
                                    $('#detalleParrafo').text(detalleParrafo);
                                    $('#detalleParrafo').css('color', '#000000');
                                    $('#detailCard').css('background-color', '#ffeea6');
                                    $('#valorDiv').css('display', 'block');
                                    $('#valor').css('display', 'block');
                                    $('.userData').css('display', 'block');
                                    $('#transactionAlert').html('Recibirás una notificación por correo electrónico una vez que el pago haya sido procesado. Gracias por tu paciencia..')
                                    $('#pagPrincipalButtonDiv').css('display','block');
                                }

                                valor = currencyFormatter({
                                    currency: 'USD',
                                    value: valor
                                });

                                $('#requestID').text(requestID);
                                $('#fecha').text(fechaTransaccion);
                                $('#concepto').text(concepto);
                                $('#referencia').text(referencia);
                                $('#usuario').text(name + ' ' + surname);
                                $('#document').text(documentType + ': ' + document);
                                $('#email').text(email);
                                $('#valor').text(valor);
                                $('#paymentMethod').text(paymentMethodName);
                                console.log(r);
                                $('#contenedor-spinner').css('display', 'none');
                            },
                            error: function (r) {
                                console.log('no obtuvo el resultado de la transaccion');
                            }
                        });
                    },
                    error: function(error){
                        console.log('error al consumir api')
                    }
                })
            }
        });

        function currencyFormatter({currency, value}) {
            const formatter = new Intl.NumberFormat('es-ES', {
                currency
            })
            return '$' + formatter.format(value)
        }

        $('#downloadPDFButton').on('click', function(){
            var doc = new jsPDF('p', 'mm', [210, 297]);
            const cunIMG = new Image();
            cunIMG.src = "resources/images/cun-logo-ext.png"

            //doc.addImage(cunIMG, 'png', 25, 30, 170, 180);
            //doc.addFont('Montserrat-VariableFont_wght');
            //doc.setFont('Montserrat-VariableFont_wght');

            cunIMG.onload = () => {
                let pageWidth = doc.internal.pageSize.getWidth();
                let imgWidth = 60;
                let imgHeight = 50;
                let centeredX = (pageWidth - imgWidth) / 2;

                doc.addImage(cunIMG, 'png', centeredX, 10, imgWidth, imgHeight);
                /*
                doc.addFileToVFS('Montserrat-VariableFont_wght.ttf', 'resources/js/fonts/Montserrat-VariableFont_wght.ttf');
                doc.addFont(
                    "Montserrat-VariableFont_wght-normal.ttf",
                    "Montserrat-VariableFont_wght",
                    "normal"
                );

                doc.setFont('Montserrat-VariableFont_wght','Arial');
                */

                if (estado == 'APPROVED') {
                    doc.setTextColor(0, 179, 136);
                    doc.setFontSize(50);
                    doc.text(estadoParrafo, pageWidth / 2, 80, { align: 'center' });
                    doc.setFontSize(15);
                    doc.setTextColor(33, 37, 41)
                    doc.text(detalleParrafo, pageWidth / 2, 95, { align: 'center' });

                    let fontSize = 20;
                    doc.setFontSize(fontSize);

                    doc.text(32, 120, 'Fecha');
                    dater = new Date(dater);

                    dater = dater.toLocaleTimeString('es-ES', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric'
                    });

                    console.log(typeof(dater));
                    let wordWidth = doc.getTextWidth(dater);
                    let xPos = pageWidth - wordWidth - 32;
                    doc.text(dater, xPos, 120);

                    doc.text(32, 140, 'Nombre');
                    wordWidth = doc.getTextWidth(name + ' ' + surname);
                    xPos = pageWidth - wordWidth - 32;
                    doc.text(name + ' ' + surname, xPos, 140);

                    doc.text(32, 160, 'Documento');
                    wordWidth = doc.getTextWidth(documentType + ': ' + document);
                    xPos = pageWidth - wordWidth - 32;
                    doc.text(documentType + ': ' + document, xPos, 160);

                    doc.text(32, 180, 'Correo');
                    wordWidth = doc.getTextWidth(email);
                    xPos = pageWidth - wordWidth - 32;
                    doc.text(email, xPos, 180);

                    //doc.text(85, 140, email);
                    doc.text(32, 200, 'Método de pago');
                    wordWidth = doc.getTextWidth(paymentMethodName);
                    xPos = pageWidth - wordWidth - 32;
                    doc.text(paymentMethodName, xPos, 200);

                    //doc.text(90, 150, paymentMethodName,  { align: 'left' });
                    doc.text(32, 220, 'Total pagado');
                    wordWidth = doc.getTextWidth(valor);
                    xPos = pageWidth - wordWidth - 32;
                    doc.text(valor, xPos, 220);
                }

                if (estado == 'REJECTED') {
                    doc.setTextColor(206, 0, 88);
                    doc.setFontSize(50);
                    doc.text(estadoParrafo, pageWidth / 2, 80, { align: 'center' });

                    doc.setFontSize(15);
                    doc.setTextColor(33, 37, 41)
                    doc.text(detalleParrafo, pageWidth / 2, 95, { align: 'center' });

                    let fontSize = 20;
                    doc.setFontSize(fontSize);

                    doc.text(32, 120, 'Fecha');
                    dater = new Date(dater);

                    dater = dater.toLocaleTimeString('es-ES', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric'
                    });

                    let wordWidth = doc.getTextWidth(dater);
                    let xPos = pageWidth - wordWidth - 32;
                    doc.text(dater, xPos, 120);

                    doc.text(32, 140, 'Nombre');
                    wordWidth = doc.getTextWidth(name + ' ' + surname);
                    xPos = pageWidth - wordWidth - 32;
                    doc.text(name + ' ' + surname, xPos, 140);

                    doc.text(32, 160, 'Método de pago');
                    wordWidth = doc.getTextWidth(paymentMethodName);
                    xPos = pageWidth - wordWidth - 32;
                    doc.text(paymentMethodName, xPos, 160);
                }

                //doc.text(85, 160, valor);
                doc.save('comprobante-pago.pdf');
            }

        });
    });

    /*
    html2canvas(document.getElementById('table'))
        .then(function(body) {
            return html2canvas(document.getElementById('detalleParrafo'))
                .then(function(detailParagraph) {
                    return html2canvas(document.getElementById('estadoParrafo'))
                        .then(function(statusParagraph) {
                            return html2canvas(document.getElementById('imgEstado'))
                                .then(function(statusIMGCanvas) {
                                    return html2canvas(document.getElementById('superiorBar'))
                                        .then(function (superiorBar) {
                                            let detailParagraphIMG = detailParagraph.toDataURL('image/png');
                                            let bodyIMG = body.toDataURL('image/png');
                                            let statusParagraphIMG = statusParagraph.toDataURL('image/png');
                                            let statusIMG = statusIMGCanvas.toDataURL('image/png');
                                            let superiorBarIMG = superiorBar.toDataURL('image/png');
                                            let doc = new jsPDF();
                                            doc.addImage(superiorBar, 'PNG', -145, 10);
                                            doc.addImage(statusIMG, 'PNG', 97, 40);
                                            doc.addImage(statusParagraphIMG, 'PNG', -8, 70);
                                            doc.addImage(detailParagraphIMG, 'PNG', -8, 100);
                                            doc.addImage(bodyIMG, 'PNG', 30, 130);
                                            doc.save('comprobante-pago.pdf');
                                        })
                                })
                        })
                })
        });
*/
</script>


</body>
</html>
