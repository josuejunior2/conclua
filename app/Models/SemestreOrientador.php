<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SemestreOrientador extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'semestre_orientador';

    protected $fillable = ['semestre_id', 'orientador_id'];


}
