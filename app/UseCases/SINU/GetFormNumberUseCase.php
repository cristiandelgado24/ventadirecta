<?php

namespace App\UseCases\SINU;

use App\Repositories\Contracts\SINU\SINURepositoryInterface;
use App\UseCases\Contracts\SINU\GetFormNumberUseCaseInterface;

class GetFormNumberUseCase implements GetFormNumberUseCaseInterface
{
    protected SINURepositoryInterface $SINURepository;

    public function __construct(SINURepositoryInterface $SINURepository)
    {
        $this->SINURepository = $SINURepository;
    }

    public function handle(string $document)
    {
        $preregistration = $this->SINURepository->getPreregistration($document);

        if (isset($preregistration)) {
            return json_encode([
                'status' => 200,
                'form_number' => $preregistration->num_formulario
            ]);
        }

        return json_encode([
            'status' => 400,
            'message' => 'There is not form number'
        ]);


    }




}
