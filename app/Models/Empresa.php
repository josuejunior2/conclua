<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Empresa extends Model
{
    use HasFactory,  SoftDeletes;

    protected $keyType = 'string';

    protected $fillable = ['nome', 'email', 'cnpj'];

    public function academicosEstagio()
    {
        return $this->hasMany(AcademicoEstagio::class, 'empresa_id');
    }
}
