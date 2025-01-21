<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class AcademicoTCC extends Model
{
    use HasFactory,  SoftDeletes;
    protected $table = 'academico_TCC';

    protected $keyType = 'string';

    protected $fillable = ['academico_id', 'orientacao_id', 'semestre_id', 'tema', 'problema', 'objetivo_especifico', 'objetivo_geral', 'justificativa', 'metodologia'];

    public function Orientacao(){
        return $this->belongsTo(Orientacao::class, 'orientacao_id');
    }

    public function Academico(){
        return $this->belongsTo(Academico::class, 'academico_id');
    }

    public function AcademicoTrashed(){
        return $this->belongsTo(Academico::class, 'academico_id')->withTrashed();
    }

    public function Semestre(){
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }

    // public function Atual(){
    //     return $this->where('semestre_id', session('semestre_id'));
    // }
}
