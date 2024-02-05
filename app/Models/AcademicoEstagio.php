<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicoEstagio extends Model
{
    use HasFactory;
    protected $table = 'academicos_estagio';

    protected $fillable = ['academico_id', 'orientadorGeral_id', 'tema', 'funcao', 'empresa_id'];

    public function Empresa(){
        return $this->belongsTo('App\Models\Empresa'); // academicoEstagio tem 1 empresa, ele olha a FK
    }
}
