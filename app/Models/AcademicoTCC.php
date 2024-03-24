<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicoTCC extends Model
{
    use HasFactory;
    protected $table = 'academicos_tcc';

    protected $fillable = ['academico_id', 'orientacao_id', 'tema', 'problema', 'objetivo_especifico', 'objetivo_geral', 'justificativa', 'metodologia'];

    public function Orientacao(){
        return $this->belongsTo('App\Models\Orientacao', 'orientacao_id');
    }

    public function Academico(){
        return $this->belongsTo('App\Models\Academico', 'academico_id');
    }
}
