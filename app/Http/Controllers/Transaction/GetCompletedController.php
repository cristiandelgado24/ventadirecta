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
        $completedTransaction = TransactionCompleted::where([
            ['estado', 0]
        ])
            ->orderBy('created_at', 'asc')
            ->get();

        return $completedTransaction;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
