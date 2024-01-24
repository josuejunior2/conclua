<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicoTCC extends Model
{
    use HasFactory;
    protected $table = 'academicos_tcc';

    protected $fillable = ['academico_id', 'orientadorGeral_id', 'tema', 'resumo'];

}
