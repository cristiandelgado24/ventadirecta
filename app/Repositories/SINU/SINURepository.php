<?php

namespace App\Repositories\SINU;

use App\Models\SINUPreregistration;
use App\Repositories\Contracts\SINU\SINURepositoryInterface;

class SINURepository implements SINURepositoryInterface
{

    public function getPreregistration(string $document)
    {
       return SINUPreregistration::where('NUM_IDENTIFICACION', $document)->first();
    }

    public function userPreregistration()
    {

    }
}
