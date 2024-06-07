<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Academico extends Authenticatable
{
    use HasFactory, HasRoles, HasUuids;

    protected $guard_name = 'web';

    protected $keyType = 'string';

    protected $fillable = ['user_id', 'matricula'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function academicosTCC(){
        return $this->hasMany(AcademicoTCC::class, 'academico_id');
    }

    public function academicosEstagio(){
        return $this->hasMany(AcademicoEstagio::class, 'academico_id');
    }

    public function solicitacoes(){
        return $this->hasMany(Solicitacao::class, 'academico_id');
    }

    public function orientacoes(){
        return $this->hasMany(Orientacao::class, 'academico_id');
    }

    public function cadastrosAtivos(){// era bom eu mudar esse nome do metodo...
        return $this->belongsToMany(Semestre::class, 'semestre_academico', 'academico_id', 'semestre_id');
    }
}
