<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class AcademicoEstagio extends Model
{
    use HasFactory,  SoftDeletes;
    protected $table = 'academico_estagio';

    protected $keyType = 'string';

    protected $fillable = ['academico_id', 'semestre_id', 'orientacao_id', 'tema', 'setor_atuacao', 'empresa_id', 'supervisor', 'email_supervisor'];

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

    public function AcademicoTrashed(){
        return $this->belongsTo(Academico::class, 'academico_id')->withTrashed();
    }

}
