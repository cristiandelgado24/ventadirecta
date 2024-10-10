<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(string $document)
 * @method static where(string $string, string $document)
 */
class SINUPreregistration extends Model
{
    use HasFactory;

    protected $table = 'sinu.SRC_FORMULARIO';
}
