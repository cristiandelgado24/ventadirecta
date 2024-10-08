<?php

namespace App\UseCases\Contracts\Transaction;

interface SendEmailUseCaseInterface
{
    public function handle($email, $name, $headerText, $reference = null, $user = null,
                           $password = null, $pending = false, $approved = false, $rejected = false, $cancelled = false);
}
