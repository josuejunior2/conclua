<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Academico extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = ['nome', 'email', 'password', 'matricula'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function AcademicoTCC(){
        return $this->hasOne('App\Models\AcademicoTCC', 'academico_id');
    }

    public function AcademicoEstagio(){
        return $this->hasOne('App\Models\AcademicoEstagio', 'academico_id');
    }

    public function solicitacoes(){
        return $this->hasMany('App\Models\Solicitacao', 'academico_id');
    }

    public function Orientacao(){
        return $this->hasOne('App\Models\Orientacao', 'academico_id');
    }
}
