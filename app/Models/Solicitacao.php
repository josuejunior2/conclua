<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $table = 'solicitacoes';

    protected $fillable = ['academico_id', 'semestre_id', 'orientador_id', 'status', 'mensagem'];

    public function Academico(){
        return $this->belongsTo('App\Models\Academico', 'academico_id'); //
    }

    public function Orientador(){
        return $this->belongsTo('App\Models\Orientador', 'orientador_id'); //
    }

    public function Semestre(){
        return $this->belongsTo('App\Models\Semestre', 'semestre_id'); //
    }

    public function Orientacao(){
        return $this->hasOne('App\Models\Orientacao', 'solicitacao_id');
    }
}