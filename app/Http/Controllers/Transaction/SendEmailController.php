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
        $sendEmailDTO->name = strval($request->input('name'));
        $sendEmailDTO->email = strval($request->input('email'));
        $sendEmailDTO->headerText = strval($request->input('headerText'));
        $sendEmailDTO->reference = strval($request->input('reference'));
        $sendEmailDTO->user = strval($request->input('user'));
        $sendEmailDTO->password = strval($request->input('password'));
        $sendEmailDTO->pending = boolval($request->input('pending'));
        $sendEmailDTO->approved = boolval($request->input('approved'));
        $sendEmailDTO->rejected = boolval($request->input('rejected'));
        $sendEmailDTO->cancelled = boolval($request->input('cancelled'));

        return $this->sendEmailUseCase->handle($sendEmailDTO);
    }
}
