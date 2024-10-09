<?php

namespace App\Http\Controllers\Transaction;

use App\DTOs\Transaction\SendEmailDTO;
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
        $sendEmailDTO = new SendEmailDTO();
        $sendEmailDTO->name = $request->input('name');
        $sendEmailDTO->email = $request->input('email');
        $sendEmailDTO->headerText = $request->input('headerText');
        $sendEmailDTO->reference = $request->input('reference');
        $sendEmailDTO->user = $request->input('user');
        $sendEmailDTO->password = $request->input('password');
        $sendEmailDTO->pending = $request->input('pending');
        $sendEmailDTO->approved = $request->input('approved');
        $sendEmailDTO->rejected = $request->input('rejected');
        $sendEmailDTO->cancelled = $request->input('cancelled');

        return $this->sendEmailUseCase->handle($sendEmailDTO);
    }
}
