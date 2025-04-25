<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        /* // Crear permisos para todos los módulos
        $permissions = [
            'ver-ventas',
            'crear-ventas',
            'editar-ventas',
            'eliminar-ventas',
            'ver-medidas',
            'crear-medidas',
            'editar-medidas',
            'eliminar-medidas',
            'ver-pedidos',
            'crear-pedidos',
            'editar-pedidos',
            'eliminar-pedidos',
            'ver-categorias',
            'crear-categorias',
            'editar-categorias',
            'eliminar-categorias',
            'ver-productos',
            'crear-productos',
            'editar-productos',
            'eliminar-productos',
            'ver-compras',
            'crear-compras',
            'editar-compras',
            'eliminar-compras',
            'ver-proveedores',
            'crear-proveedores',
            'editar-proveedores',
            'eliminar-proveedores',
            'ver-clientes',
            'crear-clientes',
            'editar-clientes',
            'eliminar-clientes',
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'eliminar-usuarios',
            'ver-permisos',
            'crear-permisos',
            'editar-permisos',
            'eliminar-permisos',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'admin']);
        $usuario = Role::create(['name' => 'usuario']);

        // Admin tiene todos los permisos
        $admin->givePermissionTo($permissions);

        // Usuario tiene permisos específicos
        $usuarioPermissions = [
            'ver-clientes',
            'crear-clientes',
            'editar-clientes',
            'eliminar-clientes',
            'ver-ventas',
            'crear-ventas',
            'editar-ventas',
            'eliminar-ventas',
            'ver-productos',
            'ver-compras',
            'crear-compras',
            'editar-compras',
            'eliminar-compras',
        ];
        $usuario->givePermissionTo($usuarioPermissions);

        // Asignar roles a usuarios específicos (opcional)
        $adminUser = \App\Models\User::find(1); // Cambia el ID según tu usuario admin
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        $normalUser = \App\Models\User::find(2); // Cambia el ID según tu usuario normal
        if ($normalUser) {
            $normalUser->assignRole('usuario');
        } */

        //El Sistema Va tener Dos Roles: Administrador y empleado

        $gerentepropietario = Role::create(['name' => 'gerentepropietario']);
        $trabajador = Role::create(['name' => 'trabajador']);

        Permission::create(['name' => 'index'])->syncRoles([$gerentepropietario,$trabajador]);
        Permission::create(['name' => 'users'])->syncRoles([$gerentepropietario]);
        Permission::create(['name' => 'permisos'])->syncRoles([$gerentepropietario]);
        Permission::create(['name' => 'roles'])->syncRoles([$gerentepropietario]);
        Permission::create(['name' => 'home'])->syncRoles([$gerentepropietario]);
        Permission::create(['name' => 'categorias'])->syncRoles([$gerentepropietario]);
        Permission::create(['name' => 'proveedores'])->syncRoles([$gerentepropietario]);
        Permission::create(['name' => 'productos'])->syncRoles([$gerentepropietario,$trabajador]);
        Permission::create(['name' => 'pedidos'])->syncRoles([$gerentepropietario]);
        Permission::create(['name' => 'ventas'])->syncRoles([$gerentepropietario,$trabajador]);
        Permission::create(['name' => 'clientes'])->syncRoles([$gerentepropietario,$trabajador]);
        Permission::create(['name' => 'medidas'])->syncRoles([$gerentepropietario,$trabajador]);
        Permission::create(['name' => 'compras'])->syncRoles([$gerentepropietario,$trabajador]);

        /* User::find(1)->assignRole($gerentepropietario);
        User::find(2)->assignRole($trabajador); */

        $user1 = User::create([
            'name' => 'ADMINISTRADOR',
            'email' => 'sistemafermin@gmail.com',
            'password' => Hash::make('admin$1590?')
        ]);
    
        $user2 = User::create([
            'name' => 'TRABAJADOR',
            'email' => 'trabajador@gmail.com',
            'password' => Hash::make('turnodia247?')
        ]);
    
        $user1->assignRole($gerentepropietario);
        $user2->assignRole($trabajador);
    }
}