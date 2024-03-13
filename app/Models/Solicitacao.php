<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $table = 'solicitacoes';

    protected $fillable = ['academico_id', 'orientadorGeral_id', 'status', 'mensagem'];

    public function Academico(){
        return $this->belongsTo('App\Models\Academico', 'academico_id'); //
    }

    public function OrientadorGeral(){
        return $this->belongsTo('App\Models\OrientadorGeral', 'orientadorGeral_id'); //
    }
}
