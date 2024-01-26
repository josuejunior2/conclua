<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class OrientadorGeral extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'orientadores_geral';
    
    protected $fillable = ['masp', 'name', 'email', 'password', 'formacao_id', 'area_id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
