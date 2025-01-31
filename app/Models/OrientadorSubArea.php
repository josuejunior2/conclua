<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrientadorSubArea extends Model
{
    use HasFactory;

    protected $table = 'orientador_sub_area';

    protected $fillable = ['orientador_id', 'sub_area_id'];
}
