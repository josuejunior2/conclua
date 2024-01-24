<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrientadorGeral extends Model
{
    use HasFactory;

    protected $table = 'orientadores_geral';
    protected $fillable = ['masp', 'name', 'email', 'password', 'formacao_id', 'area_id'];
}
