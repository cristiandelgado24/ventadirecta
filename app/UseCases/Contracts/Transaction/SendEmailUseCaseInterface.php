<?php

namespace App\UseCases\Contracts\Transaction;

use App\DTOs\Transaction\SendEmailDTO;

interface SendEmailUseCaseInterface
{
    public function handle(SendEmailDTO $sendEmailDTO);
}
