<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AcademicoEstagio extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'academico_estagio';

    protected $keyType = 'string';

    protected $fillable = ['academico_id', 'semestre_id', 'orientacao_id', 'tema', 'funcao', 'empresa_id'];

    public function Empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id'); // academicoEstagio tem 1 empresa, ele olha a FK
    }

    public function Orientacao(){
        return $this->belongsTo(Orientacao::class, 'orientacao_id');
    }

    public function Semestre(){
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }

    public function Academico(){
        return $this->belongsTo(Academico::class, 'academico_id');
    }



}
