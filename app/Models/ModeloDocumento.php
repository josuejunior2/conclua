<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloDocumento extends Model
{
    use HasFactory;

    protected $table = "modelos_documento";

    protected $fillable = ['nome', 'descricao', 'modalidade', 'data_limite'];
    
    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'modelo_documento_id');
    }

    public function getNomeModalidade()
    {
        if(empty($this->modalidade)) {
            return "TCC e Estágio";
        }
        elseif($this->modalidade == "tcc") {
            return "TCC";
        }
        elseif($this->modalidade == "estagio") {
            return "Estágio";
        }
    }
    
    public function arquivosModelo()
    {
        return $this->arquivos->whereNull('orientacao_id');
    }
    
    public function arquivosOrientacao($orientacao)
    {
        return $this->arquivos->where('orientacao_id', $orientacao);
    }
    
    public function isAtrasado($orientacao)
    {
        if(!empty($this->data_limite)){
            if(now() > \Carbon\Carbon::parse($this->data_limite) && !(count($this->arquivosOrientacao($orientacao)) > 0)){
                return true;
            }
        }
        return false;
    }
}
