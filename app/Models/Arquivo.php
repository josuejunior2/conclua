<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Arquivo extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['nome', 'atividade_id', 'caminho', 'academico_id', 'orientador_id'];

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
}
