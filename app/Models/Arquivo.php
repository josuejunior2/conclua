<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Arquivo extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = ['nome', 'atividade_id', 'submissao_atividade_id', 'caminho', 'academico_id', 'orientador_id', 'modelo_documento_id', 'orientacao_id', 'status_documentacao'];

    public function Atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
    
    public function SubmissaoAtividade()
    {
        return $this->belongsTo(SubmissaoAtividade::class);
    }
    
    public function ModeloDocumento()
    {
        return $this->belongsTo(ModeloDocumento::class);
    }
    
    public function Orientacao()
    {
        return $this->belongsTo(Orientacao::class);
    }

    public function getStatusDocumentacao()
    {
        if($this->status_documentacao === null) {
            return [
                'status' => "Em análise",
                'badge' => "yellow"
            ];
        } elseif($this->status_documentacao === 0) {
            return [
                'status' => "Reprovado",
                'badge' => "red"
            ];
        } elseif($this->status_documentacao === 1) {
            return [
                'status' => "Aprovado",
                'badge' => "green"
            ];
        }
    }
}
