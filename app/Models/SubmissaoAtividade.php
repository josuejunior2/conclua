<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class SubmissaoAtividade extends Model
{
    use HasFactory,  SoftDeletes;
    
    protected $table = 'submissao_atividade';

    protected $fillable = ['atividade_id', 'comentario'];

    public function Atividade()
    {
        return $this->belongsTo(Atividade::class, 'atividade_id');
    }
    
    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'submissao_atividade_id');
    }

}
