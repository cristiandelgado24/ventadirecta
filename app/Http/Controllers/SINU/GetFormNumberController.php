<?php

namespace App\Http\Controllers\SINU;

use App\Http\Controllers\Controller;
use App\UseCases\Contracts\SINU\GetFormNumberUseCaseInterface;
use Illuminate\Http\Request;

class GetFormNumberController extends Controller
{
    protected GetFormNumberUseCaseInterface $getFormNumberUseCase;

    public function __construct(GetFormNumberUseCaseInterface $getFormNumberUseCase)
    {
        $this->getFormNumberUseCase = $getFormNumberUseCase;
    }

    public function __invoke(string $document)
    {
        return $this->getFormNumberUseCase->handle($document);
    }
}
