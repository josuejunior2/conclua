<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Roles; 

class Role extends Roles
{
    use HasFactory;
}
