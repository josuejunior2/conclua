<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Atividade extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['orientacao_id', 'titulo', 'descricao', 'nota', 'data_limite', 'data_entrega'];

    public function Orientacao()
    {
        return $this->belongsTo(Orientacao::class);
    }

    public function SubmissaoAtividade()
    {
        return $this->hasOne(SubmissaoAtividade::class, 'atividade_id');
    }
}
