<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Orientador extends Authenticatable
{
    use HasFactory, HasRoles, HasUuids;

    protected $guard_name = 'admin';

    protected $table = 'orientadores';

    protected $fillable = ['masp', 'status', 'nome', 'email', 'password', 'formacao_id', 'area_id', 'disponibilidade', 'subArea1', 'subArea2', 'subArea3', 'areaPesquisa1', 'areaPesquisa2', 'areaPesquisa3', 'areaPesquisa4', 'areaPesquisa5', 'enderecoLattes', 'enderecoOrcid'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function Formacao(){
        return $this->belongsTo('App\Models\Formacao'); // orientador tem 1 Formacao, ele olha a FK
    }

    public function Area(){
        return $this->belongsTo('App\Models\Area'); // orientador tem 1 Area, ele olha a FK
    }

    public function solicitacoes(){
        return $this->hasMany('App\Models\Solicitacao');
    }

    public function orientacoes(){
        return $this->hasMany('App\Models\Orientacao', 'orientador_id');
    }
}
