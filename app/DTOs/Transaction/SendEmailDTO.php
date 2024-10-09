<?php

namespace App\DTOs\Transaction;

class SendEmailDTO
{
    public $email;
    public $name;
    public $headerText;
    public $reference;
    public $user;
    public $password;
    public $pending;
    public $approved;
    public $rejected;
    public $cancelled;
}
