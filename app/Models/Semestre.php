<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $fillable = ['ano', 'numero', 'data_inicio', 'data_fim', 'limite_doc_estagio', 'limite_orientacao', 'status'];
}