<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrientadorGeral extends Model
{
    use HasFactory;

    protected $table = 'orientadoresgeral';
    protected $fillable = ['maspOrientador', 'nomeOrientador', 'emailOrientador', 'senhaOrientador', 'formacao_id', 'area_id'];
}
