<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AcademicoTCC extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'academicos_tcc';

    protected $keyType = 'string';

    protected $fillable = ['academico_id', 'orientacao_id', 'semestre_id', 'tema', 'problema', 'objetivo_especifico', 'objetivo_geral', 'justificativa', 'metodologia'];

    public function Orientacao(){
        return $this->belongsTo('App\Models\Orientacao', 'orientacao_id');
    }

    public function Academico(){
        return $this->belongsTo('App\Models\Academico', 'academico_id');
    }

    public function Semestre(){
        return $this->belongsTo('App\Models\Semestre', 'semestre_id');
    }
}
