<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Solicitacao extends Model
{
    use HasFactory,  SoftDeletes;

    protected $table = 'solicitacoes';

    protected $keyType = 'string';

    protected $fillable = ['academico_id', 'academico_tcc_id', 'academico_estagio_id', 'semestre_id', 'orientador_id', 'status', 'mensagem'];

    public function Academico(){
        return $this->belongsTo(Academico::class, 'academico_id'); //
    }

    public function Orientador(){
        return $this->belongsTo(Orientador::class, 'orientador_id'); //
    }

    public function Semestre(){
        return $this->belongsTo(Semestre::class, 'semestre_id'); //
    }

    public function Orientacao(){
        return $this->hasOne(Orientacao::class, 'solicitacao_id');
    }

    public function AcademicoTCC(){
        return $this->belongsTo(AcademicoTCC::class, 'academico_tcc_id');
    }

    public function AcademicoEstagio(){
        return $this->belongsTo(AcademicoEstagio::class, 'academico_estagio_id');
    }
}
