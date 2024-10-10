<?php

namespace App\Repositories\Contracts\SINU;

interface SINURepositoryInterface
{
    public function getPreregistration(string $document);
    public function userPreregistration();
}
