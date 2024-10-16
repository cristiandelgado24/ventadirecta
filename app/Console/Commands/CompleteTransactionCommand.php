<?php

namespace App\Console\Commands;

use App\Models\TransactionCompleted;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class CompleteTransactionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            set_time_limit(0);
            $completedTransactions = TransactionCompleted::where([
                ['estado', 0]
            ])
                ->orderBy('created_at', 'asc')
                ->get();

            //Storage::append('messages.txt', 'Las transacciones sin completar son las siguientes '. print_r($completedTransactions , true));

            $loginData = [
                'username' => getenv('USUARIO_SERVICIOS'),
                'password' => getenv('PASSWORD_SERVICIOS')
            ];

            $client = new Client();

            $url = getenv('SERVICIOS_CUN_API');
            $appURL = getenv('APP_URL');

            $response = $client->post($url . '/api/v1/auth/login', [
                'json' => $loginData,
            ]);

            $accessToken = json_decode($response->getBody())->access_token;
            //Storage::append('messages.txt', 'EL TOKEN ES: '.$accessToken);
            //Storage::append('messages.txt', 'LA REFERENCIA ES: '.$completedTransactions[0]['referencia']);

            if (isset($accessToken)) {
                foreach ($completedTransactions as $completedTransaction) {
                    $response = $client->request(Request::METHOD_GET, $url . '/api/v1/checkout/payment-transaction/' . $completedTransaction['referencia'], [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $accessToken,
                            'Accept' => 'application/json'
                        ]
                    ]);

                    $requestID = json_decode($response->getBody())->requestId;

                    if (isset($requestID)) {
                        $response = $client->request(Request::METHOD_GET, $url . '/api/v1/payment-gateway/find-transaction/' . $requestID, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $accessToken,
                                'Accept' => 'application/json'
                            ]
                        ]);

                        $respuestaPagosResult = json_decode($response->getBody());

                        Storage::append('messages.txt', 'EL CUERPO DE LA RESPUESTA ES EL SIGUIENTE: '.print_r($respuestaPagosResult, true));

                        if ((isset($respuestaPagosResult->status->status)) && ($respuestaPagosResult->status->status == 'APPROVED'
                                || $respuestaPagosResult->status->status == 'REJECTED')) {

                                $email = strval($respuestaPagosResult->request->buyer->email);
                                $userName = $respuestaPagosResult->request->buyer->name.' '.$respuestaPagosResult->request->buyer->surname;
                                $reference = strval($respuestaPagosResult->request->payment->reference);
                                $headerText = null;
                                $loginUser = null;
                                $loginPassword = null;

                            if ($respuestaPagosResult->status->status == 'APPROVED') {
                                $headerText = '¡Gracias por completar la transacción!';
                                $loginUser = $respuestaPagosResult->request->buyer->document;
                                $response = $client->request(Request::METHOD_GET, $appURL . '/api/v1/SINU/form-number/' . $loginUser);
                                $formNumberStatus = json_decode($response->getBody()->getContents())->status;
                                $loginPassword = json_decode($response->getBody())->message;
                                $approvedStatus = true;
                                $rejectedStatus = false;
                                $pendingStatus = false;
                                $cancelledStatus = false;

                                //Storage::append('messages.txt', 'EL USUARIO ES EL SIGUIENTE: '.$respuestaPagosResult->request->buyer->name.' '.$respuestaPagosResult->request->buyer->surname);
                                //Storage::append('messages.txt', 'EL NUMERO DE FORMULARIO ES EL SIGUIENTE: '.print_r($loginPassword, true));
                                //Storage::append('messages.txt', 'LA PREINSCRIPCION ES LA SIGUIENTE: '.gettype($formNumberStatus));
                                //Storage::append('messages.txt', 'LA PREINSCRIPCION ES LA SIGUIENTE: '.print_r(json_decode($response->getBody()->getContents()), true));
                                //Storage::append('messages.txt', 'LA URL ES LA SIGUIENTE: '.$appURL . '/api/v1/SINU/form-number/'.$loginUser);
                                //$loginPassword = json_decode($response->getBody())->form_number;
                                //Storage::append('messages.txt', 'EL DOCUMENTO ES EL SIGUIENTE: '.$respuestaPagosResult->request->buyer->document);
                            }

                            if ($respuestaPagosResult->status->status == 'REJECTED') {
                                $approvedStatus = false;
                                $rejectedStatus = true;
                                $pendingStatus = false;
                                $cancelledStatus = false;
                            }

                            if ($respuestaPagosResult->status->status == 'REJECTED' && is_null($respuestaPagosResult->payment)) {
                                $approvedStatus = false;
                                $rejectedStatus = false;
                                $pendingStatus = false;
                                $cancelledStatus = true;
                            }

                            if (($respuestaPagosResult->status->status == 'APPROVED' && $formNumberStatus == 400)
                                || $respuestaPagosResult->status->status == 'REJECTED') {

                                //Storage::append('messages.txt', 'entrol al if');

                                $payload = [
                                    'email' => $email,
                                    'name' => $userName,
                                    'headerText' => $headerText,
                                    'reference' => $reference,
                                    'user' => $loginUser,
                                    'password' => $loginPassword,
                                    'pending' => $pendingStatus,
                                    'approved' => $approvedStatus,
                                    'rejected' => $rejectedStatus,
                                    'cancelled' => $cancelledStatus
                                ];

                                $response = $client->request(Request::METHOD_POST, $appURL . '/api/v1/transaction/send-email', [
                                    'json' => $payload
                                ]);

                                Storage::append('messages.txt', 'EL RESULTADO DEL ENVIO DE CORREO ES: '.print_r($response->getBody()->getContents(), true));

                                $completedTransaction->estado = 1;
                                $completedTransaction->save();
                            }
                        }
                    }
                }
            }
        } catch(\Throwable | \Exception $e) {
            Storage::append('messages.txt', 'ERROR: '. $e->getMessage());
        } finally {
            $client = null;
        }
    }
}
