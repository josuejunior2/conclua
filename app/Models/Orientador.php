<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orientador extends Model
{
    use HasFactory;
    protected $table = 'orientadores';
    protected $fillable = ['orientadorGeral_id', 'disponibilidade', 'subArea1', 'subArea2', 'subArea3', 'areaPesquisa1', 'areaPesquisa2', 'areaPesquisa3', 'areaPesquisa4', 'areaPesquisa5', 'enderecoLattes', 'enderecoOrcid'];

    public function OrientadorGeral(){
        return $this->belongsTo('App\Models\OrientadorGeral'); // orientador tem 1 OrientadorGeral, ele olha a FK
    }
}
