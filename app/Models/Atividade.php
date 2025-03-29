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

    public function OrientacaoTrashed()
    {
        return $this->belongsTo(Orientacao::class)->withTrashed();
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
    
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'atividade_id');
    }

    public function diretorio()
    {
        return "atividade_" . $this->id;
    }
    
    public function comentariosAcademico()
    {
        return $this->comentarios()->whereNotNull('academico_id');
    }
    
    public function comentariosOrientador()
    {
        return $this->comentarios()->whereNotNull('orientador_id');
    }
}
