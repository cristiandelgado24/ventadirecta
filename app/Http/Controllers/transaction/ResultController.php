<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __invoke($reference)
    {
        return view('transaction.result', ['reference' => $reference]);
    }
}
