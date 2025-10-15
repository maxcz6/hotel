<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'display_name'];
    public $timestamps = true;
}

/**
 * Role
 *
 * Modelo simple que representa un rol del sistema (administrator, receptionist,
 * cleaning). Se utiliza junto con la tabla pivote `role_user` para asignar
 * permisos básicos. Para un sistema completo se pueden mapear Gates/Policies
 * o integrar un paquete de permisos.
 */
