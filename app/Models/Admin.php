<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; 

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles,  SoftDeletes;


    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nome',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function Orientador()
    {
        return $this->hasOne(Orientador::class);
    }
    
    public function arquivos()
    {
        return $this->morphMany(Arquivo::class, 'arquivoable');
    }
}
