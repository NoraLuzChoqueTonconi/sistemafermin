<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* public function getUserRoles()
    {
        return $this->getRoleNames();
    }

    public function hasAdminRole()
    {
        return $this->hasRole('admin'); // Usar 'admin' o 'administrador' consistentemente
    }

    public function removeAllRoles()
    {
        $this->syncRoles([]);
    }

    public function assignMultipleRoles(array $roles)
    {
        $this->syncRoles($roles);
    } */

    /* public static function assignAdminRoleToUser(int $userId)
    {
        $user = self::find($userId);
        if ($user) {
            $user->assignRole('admin'); // Usar 'admin' o 'administrador' consistentemente
        }
    } */

    /* public static function assignEmpleadoRoleToUser(int $userId)
    {
        $user = self::find($userId);
        if ($user) {
            $user->assignRole('vendedor'); // Usar 'vendedor' o 'trabajador' consistentemente, segun el seeder.
        }
    } */

    /* public static function createAndAssignRole(int $userId, string $roleName)
    {
        $role = Role::create(['name' => $roleName]);
        $user = self::find($userId);
        if ($user) {
            $user->assignRole($role);
        }
    } */

    // Agregar la creación de usuarios Admin y Trabajador aquí dentro de la clase User.
    /* public static function createAdminAndTrabajadorUsers()
    {
        $user = self::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123')
        ]);
        $user->assignRole('admin'); // Usar 'admin' o 'administrador' consistentemente

        $trabajador = self::create([
            'name' => 'Trabajador',
            'email' => 'trabajador@example.com',
            'password' => Hash::make('password123')
        ]);
        $trabajador->assignRole('vendedor'); // Usar 'vendedor' o 'trabajador' consistentemente, segun el seeder.
    } */
}
