<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Orientacao extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    protected $table = 'orientacoes';

    protected $fillable = ['academico_id', 'orientador_id', 'semestre_id', 'solicitacao_id', 'data_vinculacao'];//, 'modalidade'];

    public function Orientador(){
        return $this->belongsTo('App\Models\Orientador', 'orientador_id');
    }

    public function Academico(){
        return $this->belongsTo('App\Models\Academico', 'academico_id');
    }

    public function Solicitacao(){
        return $this->belongsTo('App\Models\Solicitacao', 'solicitacao_id');
    }
}
