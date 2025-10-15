<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'administrator', 'display_name' => 'Administrador'],
            ['name' => 'receptionist', 'display_name' => 'Recepcionista'],
            ['name' => 'cleaning', 'display_name' => 'Limpieza'],
        ];

        foreach ($roles as $r) {
            Role::updateOrCreate(['name' => $r['name']], $r);
        }
    }
}
