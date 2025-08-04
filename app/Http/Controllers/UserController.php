<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    // Asignar un rol a un usuario
    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($request->role_id);

        // Asignar rol (guarda en la tabla pivote)
        $user->roles()->attach($role->id);

        return redirect()->route('users.index')->with('status', 'Rol asignado correctamente');
    }

    // Obtener los roles de un usuario
    public function getUserRoles($userId)
    {
        $user = User::with('roles')->findOrFail($userId);
        return response()->json($user->roles);
    }

    // Eliminar un rol de un usuario
    public function removeRole($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach($roleId);

        return redirect()->route('users.index')->with('status', 'Rol eliminado correctamente');
    }

    // Sincronizar roles (reemplazar todos los roles)
    public function syncRoles(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->sync($request->role_ids);

        return redirect()->route('users.index')->with('status', 'Roles actualizados correctamente');
    }
}
