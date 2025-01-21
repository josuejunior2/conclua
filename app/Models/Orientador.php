<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; 

class Orientador extends Authenticatable
{
    use HasFactory, HasRoles,  SoftDeletes;

    protected $guard_name = 'admin';

    protected $keyType = 'string';

    protected $table = 'orientadores';

    protected $fillable = ['masp', 'admin_id', 'formacao_id', 'area_id', 'disponibilidade',  'subArea1', 'subArea2', 'subArea3', 'areaPesquisa1', 'areaPesquisa2', 'areaPesquisa3', 'areaPesquisa4', 'areaPesquisa5', 'enderecoLattes', 'enderecoOrcid'];

    public function Admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id'); // orientador tem 1 Formacao, ele olha a FK
    }

    public function AdminTrashed()
    {
        return $this->belongsTo(Admin::class, 'admin_id')->withTrashed(); // orientador tem 1 Formacao, ele olha a FK
    }

    public function Formacao()
    {
        return $this->belongsTo(Formacao::class); // orientador tem 1 Formacao, ele olha a FK
    }

    public function Area()
    {
        return $this->belongsTo(Area::class); // orientador tem 1 Area, ele olha a FK
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
        $nome = trim($this->AdminTrashed->nome);
        $partes = explode(' ', $nome);
        $primeiro = $partes[0];
        $ultimo = $partes[count($partes) - 1];
        $diretorio = strtolower($primeiro . '.' . $ultimo);

        return $diretorio;
    }

    public function orientacoesEmAndamento()
    {
        return $this->orientacoes()->where('semestre_id', session('semestre_id'))->whereNull('avaliacao_final')->orWhere('avaliacao_final', 'APTO COM RESTRICOES')->get();
    }

}
