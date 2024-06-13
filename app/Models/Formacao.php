<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Formacao extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'formacoes';

    protected $keyType = 'string';

    protected $fillable = ['id', 'nome'];
}
