<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Semestre extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['ano', 'numero', 'data_inicio', 'data_fim', 'limite_doc_estagio', 'limite_orientacao', 'status'];

    public function AcademicoEstagio(){
        return $this->hasMany('App\Models\AcademicoEstagio');
    }

    public function AcademicoTCC(){
        return $this->hasMany('App\Models\AcademicoTCC');
    }

}


