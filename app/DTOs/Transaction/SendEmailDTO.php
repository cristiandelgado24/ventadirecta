<?php

namespace App\DTOs\Transaction;

class SendEmailDTO
{
    public string $email;
    public string $name;
    public string $headerText;
    public string $reference;
    public string $user;
    public string $password;
    public string $pending;
    public bool $approved;
    public bool $rejected;
    public bool $cancelled;
}
