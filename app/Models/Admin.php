<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; 
use App\Notifications\RedefinirSenhaNotification;
use App\Notifications\VerificarEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
    
    public function sendPasswordResetNotification($token) {
        $this->notify(new RedefinirSenhaNotification($token, $this->email, $this->nome));
    }

    public function sendEmailVerificationNotification() {
        $this->notify(new VerificarEmailNotification($this->nome));
    }
}
