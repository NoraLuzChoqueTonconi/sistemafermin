<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Muestra una lista de todos los usuarios.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /* if ($request->has('roles')) {
            $user->assignMultipleRoles($request->roles);
        } */

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }
        
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        /* $user = User::all(); */
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Actualiza la información de un usuario existente en la base de datos.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Muestra los detalles de un usuario específico.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Asigna el rol de administrador a un usuario.
     */
    public function assignAdminRole(User $user)
    {
        User::assignAdminRoleToUser($user->id);
        return redirect()->back()->with('success', 'Rol de administrador asignado.');
    }

    /**
     * Asigna el rol de trabajador a un usuario.
     */
    public function assignEmpleadoRole(User $user)
    {
        User::assignEmpleadoRoleToUser($user->id);
        return redirect()->back()->with('success', 'Rol de trabajador asignado.');
    }

    /**
     * Crea un nuevo rol y lo asigna a un usuario.
     */
    public function createAndAssignRole(Request $request, User $user)
    {
        $request->validate([
            'role_name' => 'required|string|unique:roles,name',
        ]);

        User::createAndAssignRole($user->id, $request->role_name);
        return redirect()->back()->with('success', 'Rol creado y asignado.');
    }
}