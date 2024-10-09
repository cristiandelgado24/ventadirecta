<?php

namespace App\Console\Commands;

use App\Models\TransactionCompleted;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
                    $response = $client->request('GET', $url . '/api/v1/checkout/payment-transaction/'.$completedTransaction['referencia'], [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $accessToken,
                            'Accept' => 'application/json'
                        ]
                    ]);

                    $requestID = json_decode($response->getBody())->requestId;

                    if (isset($requestID)) {
                        $response = $client->request('GET', $url . '/api/v1/payment-gateway/find-transaction/'.$requestID, [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $accessToken,
                                'Accept' => 'application/json'
                            ]
                        ]);

                        $respuestaPagosResult = json_decode($response->getBody());

                        Storage::append('messages.txt', 'EL CUERPO DE LA RESPUESTA ES EL SIGUIENTE: '.print_r($respuestaPagosResult, true));

                        if ((isset($respuestaPagosResult->status->status)) && ($respuestaPagosResult->status->status == 'APPROVED'
                               || $respuestaPagosResult->status->status == 'REJECTED')) {
                            /*
                            if ($respuestaPagosResult->status->status == 'APPROVED') {
                                $approvedStatus = true;
                                $rejectedStatus = false;
                            }

                            if ($respuestaPagosResult->status->status == 'REJECTED') {
                                $approvedStatus = false;
                                $rejectedStatus = true;
                            }

                            $payload = [
                                "email" => "cristian_delgado@cun.edu.co",
                                "name" => "Cristian Delgado",
	                            "headerText" => "¡Gracias por completar la transacción!",
	                            "reference" => "123123",
	                            "user" => "user",
	                            "password" => "password",
	                            "pending" => false,
	                            "approved" => $approvedStatus,
	                            "rejected" => $rejectedStatus,
	                            "cancelled" => false
                            ];



                            $response = $client->request('POST', $appURL . '/api/v1/transaction/send-email', [
                                'json' => []
                            ]);

                            */

                            $completedTransaction->estado = 1;
                            $completedTransaction->save();
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
