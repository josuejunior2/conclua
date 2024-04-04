<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as Permissions;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Permission extends Permissions
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';
}
