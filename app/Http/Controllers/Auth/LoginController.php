<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesa el inicio de sesión
    public function login(Request $request)
    {
        // Valida las credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intenta autenticar al usuario
        if (Auth::attempt($credentials, $request->remember)) {
            // Regenera la sesión para seguridad
            $request->session()->regenerate();
            // Redirige al usuario a la página que intentaba ver o a '/dashboard'
            return redirect()->intended('/dashboard');
        }

        // Si falla la autenticación, regresa al formulario con un error
        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ])->onlyInput('email');
    }

    // Cierra la sesión del usuario
    public function logout(Request $request)
    {
        // Desautentica al usuario
        Auth::logout();
        // Invalida la sesión
        $request->session()->invalidate();
        // Regenera el token CSRF para seguridad
        $request->session()->regenerateToken();
        // Redirige al usuario a la página de inicio
        return redirect('/');
    }
}
