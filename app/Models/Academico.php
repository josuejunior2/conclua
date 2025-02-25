<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; 

class Academico extends Authenticatable
{
    use HasFactory, HasRoles, SoftDeletes;

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

    public function UserTrashed(){
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
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
        
    public function diretorio(){
        $nome = trim($this->UserTrashed->nome);
        $partes = explode(' ', $nome);
        $primeiro = $partes[0];
        $ultimo = $partes[count($partes) - 1];
        $diretorio = strtolower($primeiro . '.' . $ultimo);

        return $diretorio;
    }

    public function getTccAtual()
    {
        return session('semestre_id') ? $this->academicosTCC()->where('semestre_id', session('semestre_id'))->first() : null;
    }
    
    public function getEstagioAtual()
    {
        return session('semestre_id') ? $this->academicosEstagio()->where('semestre_id', session('semestre_id'))->first() : null;
    }

    public function getSolicitacoesAtual()
    {
        return session('semestre_id') ? $this->solicitacoes()->where('semestre_id', session('semestre_id'))->get() : null;
    }

    public function OrientacaoAtual()
    {
        return session('semestre_id') ? $this->orientacoes()->where('semestre_id', session('semestre_id'))->first() : null;
    }
}
