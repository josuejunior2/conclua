<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Semestre extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
        'limite_doc_estagio' => 'datetime',
        'limite_orientacao' => 'datetime',
        // 'status' => 'boolean',
    ];

    protected $keyType = 'string';

    protected $fillable = ['ano', 'numero', 'data_inicio', 'data_fim', 'limite_doc_estagio', 'limite_orientacao'];

    public function AcademicoEstagio(){
        return $this->hasMany(AcademicoEstagio::class);
    }

    public function AcademicoTCC(){
        return $this->hasMany(AcademicoTCC::class);
    }

    public function academicos()//                                             V FK em      |V PK em|V PK em|V FK de SemestreAcademico
    {//                                                                        V SemestreAcd|V smstr|V acad |V que ~ academico
        return $this->hasManyThrough(Academico::class, SemestreAcademico::class, 'semestre_id', 'id', 'id', 'academico_id');
    }

    public function orientadores()
    {
        return $this->hasManyThrough(Orientador::class, SemestreOrientador::class, 'semestre_id', 'id', 'id', 'orientador_id');
    }

    public function isLast(){
        return true;
    }
}


