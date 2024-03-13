<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class OrientadorGeral extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'orientadores_geral';

    protected $fillable = ['masp', 'nome', 'email', 'password', 'formacao_id', 'area_id'];
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

    public function Especifico(){
        return $this->hasOne('App\Models\Orientador', 'orientadorGeral_id');
    }

    public function solicitacoes(){
        return $this->hasMany('App\Models\Solicitacao');
    }
}
