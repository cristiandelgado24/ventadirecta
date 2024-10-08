<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\SendEmailRequest;
use App\UseCases\Contracts\Transaction\SendEmailUseCaseInterface;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    protected SendEmailUseCaseInterface $sendEmailUseCase;

    public function __construct(SendEmailUseCaseInterface $sendEmailUseCase)
    {
        $this->sendEmailUseCase = $sendEmailUseCase;
    }

    public function __invoke(SendEmailRequest $request)
    {


        $this->sendEmailUseCase->handle();
    }
}
