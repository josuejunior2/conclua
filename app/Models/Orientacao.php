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

    protected $fillable = ['academico_id', 'academico_tcc_id', 'academico_estagio_id', 'orientador_id', 'semestre_id', 'solicitacao_id', 'avaliacao_final'];

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
    
    public function tema(){
        if(!empty($this->AcademicoTCC)){
            return $this->AcademicoTCC->tema;
        } elseif (!empty($this->AcademicoEstagio)){
            return $this->AcademicoEstagio->tema;
        }
    }

    public function mensagemAvaliacaoFinal(){
        if($this->avaliacao_final == 'APTO'){
            return 'Avaliação final: APTO. Parabéns por concluir seu '.$this->modalidade().'!';
        } else if($this->avaliacao_final == 'APTO COM RESTRICOES'){
            return 'Avaliação final: APTO COM RESTRIÇÕES. Procure seu orientador e faça os ajustes necessários. Fique firme e encerre esta etapa.';
        } else if($this->avaliacao_final == 'INAPTO'){
            return 'Avaliação final: INAPTO. Converse com seu orientador. Retome suas atividades e refaça esta etapa, ela é muito importante em sua formação.';
        }
    }
}
