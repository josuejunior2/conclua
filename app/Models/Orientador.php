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

    protected $keyType = 'string';

    protected $table = 'orientadores';

    protected $fillable = ['masp', 'admin_id', 'formacao_id', 'area_id', 'disponibilidade',  'subArea1', 'subArea2', 'subArea3', 'areaPesquisa1', 'areaPesquisa2', 'areaPesquisa3', 'areaPesquisa4', 'areaPesquisa5', 'enderecoLattes', 'enderecoOrcid'];

    public function Admin(){
        return $this->belongsTo(Admin::class); // orientador tem 1 Formacao, ele olha a FK
    }

    public function Formacao(){
        return $this->belongsTo(Formacao::class); // orientador tem 1 Formacao, ele olha a FK
    }

    public function Area(){
        return $this->belongsTo(Area::class); // orientador tem 1 Area, ele olha a FK
    }

    public function solicitacoes(){
        return $this->hasMany(Solicitacao::class);
    }

    public function orientacoes(){
        return $this->hasMany(Orientacao::class, 'orientador_id');
    }

    public function semestresOrientador(){
        return $this->belongsToMany(Semestre::class, 'semestre_orientador', 'orientador_id', 'semestre_id');
    }

}
