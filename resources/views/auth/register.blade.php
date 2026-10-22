@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto">
    <div class="bg-white dark:bg-[#161615] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-xl p-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold tracking-tight text-[#1b1b18] dark:text-[#EDEDEC]">
                Crear cuenta
            </h1>
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
                Regístrate para obtener una nueva cuenta
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900 text-red-700 dark:text-red-300 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.attempt') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                    Nombre completo
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Ej. Juan Pérez"
                    class="w-full px-3.5 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors"
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                    Correo electrónico
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="usuario@ejemplo.com"
                    class="w-full px-3.5 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                    Contraseña
                </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    autocomplete="new-password"
                    placeholder="Al menos 6 caracteres"
                    class="w-full px-3.5 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors"
                >
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-1">
                    Confirmar contraseña
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Repite la contraseña"
                    class="w-full px-3.5 py-2 rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] text-sm focus:outline-none focus:ring-2 focus:ring-[#f53003]/30 focus:border-[#f53003] transition-colors"
                >
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button
                    type="submit"
                    id="submit-register"
                    class="w-full py-2.5 px-4 rounded-lg bg-[#f53003] hover:bg-[#e02b02] text-white font-medium text-sm transition-colors shadow-xs cursor-pointer text-center"
                >
                    Crear cuenta
                </button>
            </div>
        </form>

        <!-- Footer link -->
        <p class="mt-6 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="font-medium text-[#f53003] hover:underline">
                Iniciar sesión
            </a>
        </p>
    </div>
</div>
@endsection
