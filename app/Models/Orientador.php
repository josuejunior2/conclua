<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class Orientador extends Authenticatable
{
    use HasFactory, HasRoles,  SoftDeletes;

    protected $guard_name = 'admin';

    protected $keyType = 'string';

    protected $table = 'orientadores';

    protected $fillable = ['masp', 'admin_id', 'disponibilidade', 'area', 'enderecoLattes', 'enderecoOrcid'];

    public function Admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function AdminTrashed()
    {
        return $this->belongsTo(Admin::class, 'admin_id')->withTrashed();
    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class);
    }

    public function orientacoes()
    {
        return $this->hasMany(Orientacao::class, 'orientador_id');
    }

    public function orientacoesNoSemestre()
    {
        return $this->orientacoes->where('semestre_id', session('semestre_id'));
    }

    public function semestresOrientador()
    {
        return $this->belongsToMany(Semestre::class, 'semestre_orientador', 'orientador_id', 'semestre_id');
    }
    
    public function diretorio()
    {
        return "orientador_".$this->id;
    }

    public function orientacoesEmAndamento()
    {
        return $this->orientacoes()->where('semestre_id', session('semestre_id'))->whereNull('avaliacao_final')->orWhere('avaliacao_final', 'APTO COM RESTRICOES')->get();
    }

    public function subAreas()
    {
        return $this->belongsToMany(SubArea::class, 'orientador_sub_area', 'orientador_id', 'sub_area_id');
    }

}
