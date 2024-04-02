<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicoEstagio extends Model
{
    use HasFactory;
    protected $table = 'academicos_estagio';

    protected $fillable = ['academico_id', 'semestre_id', 'orientacao_id', 'tema', 'funcao', 'empresa_id'];

    public function Empresa(){
        return $this->belongsTo('App\Models\Empresa', 'empresa_id'); // academicoEstagio tem 1 empresa, ele olha a FK
    }

    public function Orientacao(){
        return $this->belongsTo('App\Models\Orientacao', 'orientacao_id');
    }

    public function Semestre(){
        return $this->belongsTo('App\Models\Semestre', 'semestre_id');
    }


}
