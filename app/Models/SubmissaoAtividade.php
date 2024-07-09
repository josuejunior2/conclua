<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SubmissaoAtividade extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    
    protected $table = 'submissao_atividade';

    protected $fillable = ['atividade_id', 'arquivo', 'comentario'];

    public function Atividade()
    {
        return $this->belongsTo(Atividade::class, 'atividade_id');
    }
}
