<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Orientacao extends Model
{
    use HasFactory,  SoftDeletes;

    protected $keyType = 'string';

    protected $table = 'orientacoes';

    protected $fillable = ['academico_id', 'academico_tcc_id', 'academico_estagio_id', 'orientador_id', 'semestre_id', 'solicitacao_id'];//, 'modalidade'];

    public function Orientador(){
        return $this->belongsTo(Orientador::class, 'orientador_id');
    }

    public function Academico(){
        return $this->belongsTo(Academico::class, 'academico_id');
    }

    public function Solicitacao(){
        return $this->belongsTo(Solicitacao::class, 'solicitacao_id');
    }

    public function AcademicoTCC(){
        return $this->belongsTo(AcademicoTCC::class, 'academico_tcc_id');
    }

    public function AcademicoEstagio(){
        return $this->belongsTo(AcademicoEstagio::class, 'academico_estagio_id');
    }

    public function modalidade(){
        if(!empty($this->AcademicoTCC)){
            return 'TCC';
        } elseif (!empty($this->AcademicoEstagio)){
            return 'Estágio';
        }
    }

    public function Semestre(){
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }
    
    public function atividades(){
        return $this->hasMany(Atividade::class, 'orientacao_id');
    }
        
    public function notaTotal(){
        $notaTotal = 0;
        foreach ($this->atividades as $atividade) {
            $notaTotal += $atividade->nota;
        }
        return $notaTotal;
    }
}
