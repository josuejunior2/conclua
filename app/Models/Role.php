<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Roles; 

class Role extends Roles
{
    use HasFactory;
    
    public function getTipoPerfil()
    {
        if($this->guard_name == 'admin') return 'Administração';
        if($this->guard_name == 'web') return 'Usuário comum';
    }
}
