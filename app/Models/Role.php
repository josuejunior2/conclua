<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Roles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Role extends Roles
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';
}
