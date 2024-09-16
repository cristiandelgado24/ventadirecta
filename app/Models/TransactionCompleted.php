<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCompleted extends Model
{
    use HasFactory;

    protected $table = 'PORTAL_PAGOS_CUN.vd_ppt_cun_transaccion_ok';
}
