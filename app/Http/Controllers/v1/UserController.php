<?php
namespace App\Http\Controllers\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    // Listar usuarios
    public function index()
    {
        $users = User::paginate(10);

        return inertia('Users/Index', [
            'users' => $users,
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return inertia('Users/Create');
    }

    // Guardar usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index');
    }

    // Mostrar formulario de edición
    public function edit(User $user)
    {
        return inertia('Users/Edit', ['user' => $user]);
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('users.index');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    // Actualizar estado del usuario
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [
                User::STATUS_ACTIVE,
                User::STATUS_INACTIVE,
                User::STATUS_SUSPENDED,
                User::STATUS_VERIFIED,
            ]),
        ]);

        $user->status = $request->status;
        $user->save();

        return redirect()->back()->with('success', 'Estado del usuario actualizado.');
    }

}
