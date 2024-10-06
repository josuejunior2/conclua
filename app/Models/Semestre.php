<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Semestre extends Model
{
    use HasFactory,  SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
    ];

    protected $keyType = 'string';

    protected $fillable = ['ano', 'periodo', 'data_inicio', 'data_fim'];

    public function academicosEstagio(){
        return $this->hasMany(AcademicoEstagio::class);
    }

    public function academicosTCC(){
        return $this->hasMany(AcademicoTCC::class);
    }

    public function isLast(){
        return true;
    }
    
    public function periodoAno(){
        return '0'.$this->periodo.'.'.$this->ano;
    }
}


