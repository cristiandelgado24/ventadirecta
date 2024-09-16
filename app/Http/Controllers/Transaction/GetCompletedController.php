<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\TransactionCompleted;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GetCompletedController extends Controller
{
    public function __invoke()
    {
        try{
        $completedTransactions = TransactionCompleted::where([
            ['estado', 0]
        ])
            ->orderBy('created_at', 'asc')
            ->get();

        return $completedTransactions;

        $loginData = [
            'username' => getenv('USUARIO_SERVICIOS'),
            'password' => getenv('PASSWORD_SERVICIOS')
        ];

        $client = new Client();
        $url = getenv('SERVICIOS_CUN_API');

        $response = $client->post($url . '/api/v1/auth/login', [
            'json' => $loginData,
        ]);

        $accessToken = json_decode($response->getBody())->access_token;

        if (isset($accessToken)) {
            $response = $client->request('GET', $url . '/api/v1/checkout/payment-transaction/'.$completedTransactions[21]['referencia'], [
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

                return json_decode($response->getBody());
            }


        }






        }catch(\Throwable  | \Exception $e){}



    }
}
