<?php

namespace App\UseCases\Transaction;

use App\DTOs\Transaction\SendEmailDTO;
use App\UseCases\Contracts\Transaction\SendEmailUseCaseInterface;

class SendEmailUseCase implements SendEmailUseCaseInterface
{
    public function handle(SendEmailDTO $sendEmailDTO)
    {
        try {
            if ($sendEmailDTO->approved) {
                $emailBody = '
        <div class="contenedor">
            <div class="header">
                <div class="header-left" style="width: 50%;"><br></div>
                <div class="header-right" style="width: 50%; padding: 5%; text-align: center;">'.$sendEmailDTO->headerText.'<br></div>
            </div>
            <div class="contenedor2">
                <div class="text">
                    <p>
                        ¡Recibimos tu pago N° <strong>'.$sendEmailDTO->reference.'</strong>! Ahora puedes comenzar tu proceso de legalización de matrícula
                        en nuestra plataforma <strong><a href="'.getenv('URL_INSCRIPCION_SINU').'">SINÚ</a></strong>, aquí están tus credenciales
                    </p>
                </div><br>
                <div class="text" style="line-height: 0;">
                    <p>Usuario: <strong>'.$sendEmailDTO->user.'</strong></p>
                    <p class="text-description">(Tu documento de identidad, sin puntos ni comas)</p>
                </div><br>
                <div class="text" style="line-height: 0;">
                    <p>Contraseña: <strong>'.$sendEmailDTO->password.'</strong></p>
                    <p class="text-description">(Tu número de pago)</p>
                </div><br>

                <div class="text" style="margin-top: 40px; margin-bottom: 30px;">
                    <a href="'.getenv('URL_INSCRIPCION_SINU').'" class="btn-one">Inicia tu proceso</a>
                </div><br>
                <div class="text">
                    <p class="text-description">
                        Recuerda que para iniciar el semestre, debes completar
                        el proceso de matrícula únicamente en nuestra plataforma.
                    </p>
                    <p class="text-description">La CUN no cuenta con tramitadores que agilizan el proceso</p>
                </div>
            </div>
            <div class="contenedor-info">
                <div class="text">
                    <p>
                            ¿No sabes cómo empezar? revisa este tutorial y sigue las instruciones.
                            Si presentas problemas, no dudes en llamarnos<br>
                    </p>
                </div>
                <div class="text" style="margin-top: 40px; margin-bottom: 30px;">
                    <a href="'.getenv('SHOW_TUTORIAL_SINU').'" class="btn-one">Ver tutorial</a>
                    <a href="'.getenv('SUPPORT_CONTACT').'" class="btn-two">Contactar soporte</a>
                </div>
            </div>
            <div class="contenedor-info2">
                <div class="text" style="line-height: 0.5;">
                    <p>¿Dudas?<br></p>
                    <p>Visítanos en:<br></p>
                    <h3>CUN.EDU.CO<br></h3>
                </div>
            </div>
            <footer>
                <p>Línea Bogotá: <strong>(+57) (601) 307 81 80</strong> | Gratis desde tu cel: <strong>01 8000 11 54 11</strong> | Sede principal Bogotá: <strong>Calle 12b #04-79</strong></p>
                <p>Corporación Unificada Nacional de Educación superior CUN - Código SNIES 4813, Colombia - Todos los derechos reservados</p>
                <p>Carácter Intitucional: Institución técnica profesional Vigilada por el Ministerio de Educación Nacional.</p>
                <p>Personería Jurídica: Resolución 1379 del 3 de febrero de 1983. Ministerio de Educación Nacional.</p>
                <p>Institución de educación superior sujeta a la inspección y vigilancia del Mineducación.</p>
                <p>Copyright&copy; 2024 | Para notificaciones judiciles: notificaciones@cun.edu.co</p>
            </footer>
        </div>
       ';
            }

            if ($sendEmailDTO->rejected) {
                $emailBody = '
        <div class="contenedor">
            <div class="header">
                <div class="header-left" style="width: 50%;"><br></div>
                <div class="header-right" style="width: 50%; padding: 5%; text-align: center;">'.$sendEmailDTO->headerText.'<br></div>
            </div>
            <div class="contenedor2">
                <div class="text">
                    <p>
                        Tu pago N° <strong>'.$sendEmailDTO->reference.'</strong> ha sido rechazado.<br>
                        Por favor, verifica tu método de pago o inténtalo nuevamente pero con otro medio desde nuestra plataforma.
                    </p>
                </div><br>
                <div class="text">
                    <a href="'.getenv('APP_URL').'" class="btn-one">Reintentar pago</a>
                </div><br>
            </div>

            <div class="contenedor-info">
                <div class="text">
                    <p>
                        Si presentas problemas con la plataforma de pago no dudes contactarnos.
                    </p>
                </div>
                <div class="text">
                <a href="'.getenv('SUPPORT_CONTACT').'" class="btn-one">Contactar soporte</a>
                </div>
            </div>
            <footer>
                <p>Línea Bogotá: <strong>(+57) (601) 307 81 80</strong> | Gratis desde tu cel: <strong>01 8000 11 54 11</strong> | Sede principal Bogotá: <strong>Calle 12b #04-79</strong></p>
                <p>Corporación Unificada Nacional de Educación superior CUN - Código SNIES 4813, Colombia - Todos los derechos reservados</p>
                <p>Carácter Intitucional: Institución técnica profesional Vigilada por el Ministerio de Educación Nacional.</p>
                <p>Personería Jurídica: Resolución 1379 del 3 de febrero de 1983. Ministerio de Educación Nacional.</p>
                <p>Institución de educación superior sujeta a la inspección y vigilancia del Mineducación.</p>
                <p>Copyright&copy; 2024 | Para notificaciones judiciles: notificaciones@cun.edu.co</p>
            </footer>
        </div>
       ';
            }

            if ($sendEmailDTO->pending) {
                $emailBody = '
        <div class="contenedor">
    <div class="header">
        <div class="header-left" style="width: 50%;"><br></div>
        <div class="header-right" style="width: 50%; padding: 5%; text-align: center;">'.$sendEmailDTO->headerText.'<br></div>
    </div>
    <div class="contenedor2">
        <div class="text">
            <p>
                Tu pago No. <strong>'.$sendEmailDTO->reference.'</strong> está pendiente de confirmación.
                <br>
                <br>
                Recibirás una notificación a este correo electrónico una vez que el pago haya sido procesado.
                <br>
                <br>
                Si ya recibiste la notificación de tu banco rechazando la transacción, por favor intenta realizar el pago nuevamente en nuestro portal:
            </p>
        </div><br>
        <div class="text">
            <a href="'.getenv('APP_URL').'" class="btn-one">Reintentar pago</a>
        </div><br>
    </div>
    <div class="contenedor-info">
        <div class="text">
            <p>
                Recuerda verificar tu información personal y de tu medio de pago antes de intentar nuevamente.
                Si presentas problemas con la plataforma de pago no dudes contactarnos.
            </p>
        </div>
        <div class="text" style="margin-top: 50px; margin-bottom: 30px;">
            <a href="'.getenv('SUPPORT_CONTACT').'" class="btn-one">Contactar soporte</a>
        </div>
    </div>
    <footer>
                <p>Línea Bogotá: <strong>(+57) (601) 307 81 80</strong> | Gratis desde tu cel: <strong>01 8000 11 54 11</strong> | Sede principal Bogotá: <strong>Calle 12b #04-79</strong></p>
                <p>Corporación Unificada Nacional de Educación superior CUN - Código SNIES 4813, Colombia - Todos los derechos reservados</p>
                <p>Carácter Intitucional: Institución técnica profesional Vigilada por el Ministerio de Educación Nacional.</p>
                <p>Personería Jurídica: Resolución 1379 del 3 de febrero de 1983. Ministerio de Educación Nacional.</p>
                <p>Institución de educación superior sujeta a la inspección y vigilancia del Mineducación.</p>
                <p>Copyright&copy; 2024 | Para notificaciones judiciles: notificaciones@cun.edu.co</p>
    </footer>
    </div>';
            }

            if ($sendEmailDTO->cancelled) {
                $emailBody = '
        <div class="contenedor">
    <div class="header">
        <div class="header-left" style="width: 50%;"><br></div>
        <div class="header-right" style="width: 50%; padding: 5%; text-align: center;">'.$sendEmailDTO->headerText.'<br></div>
    </div>
    <div class="contenedor2">
        <div class="text">
            <p>
                ¡Hola! ¿Estás listo para vivir la experiencia universitaria de tus sueños? Inscríbete ahora y recibe un descuento del 10% en la matrícula para tu primer semestre en modalidad virtual.
                <br>
                <br>
                No esperes más para asegurar tu lugar y comenzar a construir tu futuro profesional. ¡Es el momento perfecto para dar el siguiente paso!
            </p>
        </div><br>
        <div class="text">
            <a href="'.getenv('APP_URL').'" class="btn-one">Iniciar pago</a>
        </div><br>
    </div>
    <div class="contenedor-info">
        <div class="text">
            <p>
               Si presentas problemas con
               <br>
                la plataforma de pago no dudes contactarnos:
            </p>
        </div>
        <div class="text" style="margin-top: 50px; margin-bottom: 30px;">
            <a href="'.getenv('SUPPORT_CONTACT').'" class="btn-one">Contactar soporte</a>
        </div>
    </div>
    <footer>
                <p>Línea Bogotá: <strong>(+57) (601) 307 81 80</strong> | Gratis desde tu cel: <strong>01 8000 11 54 11</strong> | Sede principal Bogotá: <strong>Calle 12b #04-79</strong></p>
                <p>Corporación Unificada Nacional de Educación superior CUN - Código SNIES 4813, Colombia - Todos los derechos reservados</p>
                <p>Carácter Intitucional: Institución técnica profesional Vigilada por el Ministerio de Educación Nacional.</p>
                <p>Personería Jurídica: Resolución 1379 del 3 de febrero de 1983. Ministerio de Educación Nacional.</p>
                <p>Institución de educación superior sujeta a la inspección y vigilancia del Mineducación.</p>
                <p>Copyright&copy; 2024 | Para notificaciones judiciles: notificaciones@cun.edu.co</p>
    </footer>
    </div>';
            }

            $postData = [
                "mail_template_key" => getenv('TEMPLATE_KEY'),
                "from" => [
                    "address" => "noreply@cunapp.dev",
                    "name" => "noreply"
                ],
                "to" => [
                    [
                        "email_address" => [
                            "address" => $sendEmailDTO->email,
                            "name" => $sendEmailDTO->name
                        ],
                        "merge_info" => [
                            "emailBody" => $emailBody
                        ]
                    ]
                ]
            ];

            $jsonPostData = json_encode($postData);

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => getenv('ZEPTOMAIL_URL'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $jsonPostData,
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: Zoho-enczapikey ".getenv('ZEPTOMAIL_KEY'),
                    "cache-control: no-cache",
                    "content-type: application/json",
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            return $response;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
