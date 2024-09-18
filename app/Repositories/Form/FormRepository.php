<?php

namespace App\Repositories\Form;

use App\Repositories\Contracts\Form\FormRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FormRepository implements FormRepositoryInterface
{
    public function getDocumentTypes(): array
    {
        return DB::select(
            "SELECT
					G.COD_TABLA,
					G.NOM_TABLA
				  FROM
					SRC_GENERICA G
				  WHERE G.TIP_TABLA = 'TIPIDE'
				  AND COD_SNIES <> ' '
				  AND COD_TABLA  NOT IN 'R'
				  AND COD_TABLA  NOT IN 'N'"
        );
    }
}


