<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        /* // Crear roles
        $adminRole = Role::create(['name' => 'administrador']);
        $empleadoRole = Role::create(['name' => 'empleado']);

        // Definir permisos para cada módulo
        $modules = ['ventas', 'pedidos', 'categorias', 'productos', 'compras', 'proveedores', 'clientes', 'usuarios', 'permisos'];

        $permissions = [];

        foreach ($modules as $module) {
            $permissions[] = Permission::create(['name' => "ver $module"]);
            $permissions[] = Permission::create(['name' => "crear $module"]);
            $permissions[] = Permission::create(['name' => "editar $module"]);
            $permissions[] = Permission::create(['name' => "eliminar $module"]);
        }

        // Asignar todos los permisos al administrador
        $adminRole->givePermissionTo($permissions);

        // Permisos completos para empleados en clientes, ventas, compras y productos
        $empleadoPermissions = [
            'ver clientes', 'crear clientes', 'editar clientes', 'eliminar clientes',
            'ver ventas', 'crear ventas', 'editar ventas', 'eliminar ventas',
            'ver compras', 'crear compras', 'editar compras', 'eliminar compras',
            'ver productos', 'crear productos', 'editar productos', 'eliminar productos',
        ];

        $empleadoRole->givePermissionTo($empleadoPermissions); */
    }
}
