<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SemestreAcademico extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'semestre_academico';

    protected $fillable = ['semestre_id', 'academico_id'];


}
