<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Atividade extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = ['orientacao_id', 'titulo', 'descricao', 'nota', 'data_limite', 'data_entrega'];

    public function Orientacao()
    {
        return $this->belongsTo(Orientacao::class);
    }

    public function SubmissaoAtividade()
    {
        return $this->hasOne(SubmissaoAtividade::class, 'atividade_id');
    }
    
    public function arquivosAuxiliares()
    {
        return $this->hasMany(Arquivo::class, 'atividade_id')->whereNotNull('orientador_id');
    }

    public function arquivosSubmissao()
    {
        return $this->hasManyThrough(Arquivo::class, SubmissaoAtividade::class)->whereNotNull('academico_id');
    }

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'atividade_id');
    }

}
