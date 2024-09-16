<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __invoke($reference)
    {
        return view('transaction.result', ['reference' => $reference]);
    }
}
