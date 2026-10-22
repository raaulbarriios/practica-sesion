<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (session('token')) {
            return redirect('/');
        }

        return view('auth.login');
    }

    /**
     * Procesa el inicio de sesión.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no son correctas.',
            ])->onlyInput('email');
        }

        $token = Str::random(60);

        session([
            'token' => $token,
            'name' => $user->name,
        ]);

        return redirect('/')->with('status', '¡Bienvenido de nuevo, '.$user->name.'!');
    }

    /**
     * Cierra la sesión activa.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Muestra el formulario para crear cuenta.
     */
    public function showRegisterForm(): View|RedirectResponse
    {
        if (session('token')) {
            return redirect('/');
        }

        return view('auth.register');
    }

    /**
     * Procesa la creación de cuenta.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = Str::random(60);

        session([
            'token' => $token,
            'name' => $user->name,
        ]);

        return redirect('/')->with('status', '¡Cuenta creada con éxito!');
    }
}
