<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Form\FormRepositoryInterface;
use App\UseCases\Contracts\Form\GetDocumentTypesUseCaseInterface;
use Illuminate\Http\Request;

class GetDocumentTypesController extends Controller
{
    protected GetDocumentTypesUseCaseInterface $getDocumentTypesUseCase;

    public function __construct(GetDocumentTypesUseCaseInterface $getDocumentTypesUseCase)
    {
        $this->getDocumentTypesUseCase = $getDocumentTypesUseCase;
    }

    public function __invoke()
    {
        $this->getDocumentTypesUseCase->handle();
    }
}
