<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Muestra el formulario de registro.
    public function showRegistrationForm()
    {
        // Retorna la vista 'auth.register', que contiene el formulario de registro.
        return view('auth.register');
    }

    // Procesa el registro de un nuevo usuario.
    public function register(Request $request)
    {
        // Valida los datos de la solicitud según las reglas especificadas.
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crea un nuevo usuario en la base de datos.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Inicia sesión con el usuario recién creado.
        Auth::login($user);

        // Redirige al usuario a la ruta '/dashboard' después del registro.
        return redirect('/dashboard');
    }
}
