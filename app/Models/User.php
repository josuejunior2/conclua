<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable; 
use App\Notifications\RedefinirSenhaNotification;
use App\Notifications\VerificarEmailNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,  SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nome',
        'email',
        'password',
    ];

    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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

    public function Academico(){
        return $this->hasOne(Academico::class, 'user_id');
    }

    public function AcademicoTrashed(){
        return $this->hasOne(Academico::class, 'user_id')->withTrashed();
    }
    
    public function arquivos()
    {
        return $this->morphMany(Arquivo::class, 'arquivoable');
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new RedefinirSenhaNotification($token, $this->email, $this->name));
    }
    
    public function sendEmailVerificationNotification() {
        $this->notify(new VerificarEmailNotification($this->nome));
    }
}

