<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GenerateRespuestaPagoController extends Controller
{
    public function __invoke(int $requestID)
    {
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

        $response = $client->request('GET', $url . '/api/v1/payment-gateway/find-transaction/'.$requestID, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json'
            ]
        ]);

        $respuestaPagosResult = json_decode($response->getBody());

        return $respuestaPagosResult;
    }
}
