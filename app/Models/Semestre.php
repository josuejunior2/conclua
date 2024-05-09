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

    protected $fillable = ['ano', 'periodo', 'data_inicio', 'data_fim', 'limite_doc_estagio', 'limite_orientacao'];

    public function academicosEstagio(){
        return $this->hasMany(AcademicoEstagio::class);
    }

    public function academicosTCC(){
        return $this->hasMany(AcademicoTCC::class);
    }

    public function isLast(){
        return true;
    }
}


